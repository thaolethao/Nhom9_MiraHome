<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductCategory;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ với các danh mục và sản phẩm.
     */
    public function index()
    {
        // Lấy tất cả danh mục sản phẩm đang hoạt động
       $categories = ProductCategory::where('status', 1)->get();

        // Lấy sản phẩm theo từng danh mục
        $categoryProducts = [];
        foreach ($categories as $category) {
            $products = Product::where('category_id', $category->id)->where('status', 1)->get();
            foreach ($products as $product) {
                $this->processProductPricingAndStock($product);
            }
            $categoryProducts[$category->name] = $products;
        }

        // Lấy tất cả sản phẩm đang hoạt động
        $allProducts = Product::where('status', 1)->get();

        // Lấy các nhóm sản phẩm đặc biệt
        $newProducts = Product::where('status', 1)->latest()->take(8)->get();
        $hotProducts = Product::where('is_hot', true)->where('status', 1)->take(8)->get();
        $discountedProducts = Product::where('status', 1)
            ->whereNotNull('old_price')
            ->whereColumn('old_price', '>', 'price')
            ->take(8)
            ->get();
        $mostViewedProducts = Product::where('status', 1)->orderBy('is_most_viewed', 'desc')->take(8)->get();

        // Xử lý giá và tồn kho cho các nhóm sản phẩm đặc biệt
        foreach ([$newProducts, $hotProducts, $discountedProducts, $mostViewedProducts, $allProducts] as $products) {
            foreach ($products as $product) {
                $this->processProductPricingAndStock($product);
            }
        }

        // Breadcrumbs và banner
        $breadcrumbs = Breadcrumbs::generate('home.index');
        $banners = Banner::where('status', 1)->get();

        return view('pages.client.home', [
            'title' => 'MiraHome',
            'banners' => $banners,
            'breadcrumbs' => $breadcrumbs,
            'newProducts' => $newProducts,
            'hotProducts' => $hotProducts,
            'discountedProducts' => $discountedProducts,
            'mostViewedProducts' => $mostViewedProducts,
            'categories' => $categories,
            'categoryProducts' => $categoryProducts,
            'allProducts' => $allProducts,
        ]);
    }

    /**
     * Xử lý thông tin giá và tồn kho của sản phẩm.
     */
    private function processProductPricingAndStock($product)
    {
        $product->discount_percentage = '';

        if ($product->has_variants) {
            $prices = $product->variants->map(function ($variant) use (&$product) {
                $original_price = $variant->old_price ?? $variant->price;
                $current_price = $variant->price;

                if ($variant->old_price && $variant->old_price > $variant->price) {
                    $product->discount_percentage = round((($variant->old_price - $variant->price) / $variant->old_price) * 100);
                }

                $variant->discounted_price = $current_price;
                $variant->original_price = $original_price;

                return $current_price;
            })->toArray();

            if (count($prices) == 1) {
                $product->price_range = number_format($prices[0], 0, ',', '.') . '₫';
            } elseif (count($prices) > 1) {
                $product->price_range = number_format(min($prices), 0, ',', '.') . ' - ' . number_format(max($prices), 0, ',', '.') . '₫';
            }

            $product->total_stock = $product->variants->sum('stock');
        } else {
            $original_price = $product->old_price ?? $product->price;
            $current_price = $product->price;

            if ($product->old_price && $product->old_price > $product->price) {
                $product->discount_percentage = round((($product->old_price - $product->price) / $product->old_price) * 100);
            }

            $product->price_range = number_format($current_price, 0, ',', '.') . '₫';
            $product->total_stock = $product->stock;
        }
    }
}
