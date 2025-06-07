<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $has_variants = $request->input('has_variants');

        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
                // ->orWhere('full_name', 'like', '%' . $search . '%');
        }

        if ($has_variants !== null) {
            $query->where('has_variants', $has_variants);
        }

        $products = $query->with(['category', 'variants'])->orderBy('id', 'desc')->paginate(5);
        $title = 'Danh sách sản phẩm';

        foreach ($products as $product) {
            if ($product->has_variants) {
                $prices = $product->variants->pluck('price')->toArray();
                if (count($prices) == 1) {
                    $product->price_range = number_format($prices[0], 0, ',', '.') . '₫';
                } elseif (count($prices) > 1) {
                    $product->price_range = number_format(min($prices), 0, ',', '.') . ' - ' . number_format(max($prices), 0, ',', '.');
                }
                $product->total_stock = $product->variants->sum('stock');
            } else {
                $product->price_range = number_format($product->price, 0, ',', '.') . '₫';
                $product->total_stock = $product->stock;
            }
        }
        // Lấy các giá trị duy nhất của has_variants
        $uniqueHasVariants = Product::select('has_variants')->distinct()->pluck('has_variants');
        return view('pages.admin.products.index', compact('products', 'title', 'uniqueHasVariants'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $attributes = Attribute::all();
        $productCategories = ProductCategory::all();
        $title = 'Thêm Sản Phẩm Mới';

        return view('pages.admin.products.add', compact('attributes', 'productCategories', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         // Validate form data
        //   return $request->input();
         $validated = $request->validate([
             'product_name' => 'required|string|max:255',
             'product_description' => 'nullable|string',
             'product_type' => 'required|in:0,1',
             'product_price' => 'required_if:product_type,0|nullable|numeric',
             'stock' => 'required_if:product_type,0|nullable|integer',
             'category_id' => 'required|exists:product_categories,id',
             'main_image' => 'required|image',
             'sub_images.*' => 'image',
         ], [
             'product_name.required' => 'Vui lòng nhập tên sản phẩm.',
             'product_name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
             'product_type.required' => 'Vui lòng chọn loại sản phẩm.',
             'product_type.in' => 'Loại sản phẩm không hợp lệ.',
             'product_price.required_if' => 'Giá cơ bản là bắt buộc khi sản phẩm không có biến thể.',
             'product_price.numeric' => 'Giá cơ bản phải là một số.',
             'stock.required_if' => 'Số lượng kho là bắt buộc khi sản phẩm không có biến thể.',
             'stock.integer' => 'Số lượng kho phải là một số nguyên.',
             'category_id.required' => 'Vui lòng chọn loại sản phẩm.',
             'category_id.exists' => 'Loại sản phẩm không tồn tại.',
             'main_image.required' => 'Vui lòng tải lên ảnh chính.',
             'main_image.image' => 'Vui lòng tải lên một tệp hình ảnh hợp lệ.',
             'sub_images.*.image' => 'Vui lòng tải lên các tệp hình ảnh hợp lệ.',
         ]);
     
         // Xử lý tải ảnh chính
         if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
            $mainImage->move(public_path('images'), $mainImageName);
            $updateData['image'] = $mainImageName;
        }

     if ($request->hasFile('sub_images')) {
    foreach ($request->file('sub_images') as $image) {
        $imageName = time() . '_' . Str::uuid() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $subImages[] = $imageName;
    }
         }
    //    return   $request->input();
         // Tạo sản phẩm mới và lưu vào cơ sở dữ liệu
         $product = Product::create([
             'name' => $validated['product_name'],
             'description' => $validated['product_description'],
             'is_hot' => $request->input('hot', 0),
             'is_most_viewed' => 0,
             'status' => $request->input('status', 1),
             'has_variants' => $validated['product_type'] == 1,
             'price' => $request->input('variants.0.price') ?? $request->input('product_price'),
             'image' =>  $mainImageName,
             'sub_images' => json_encode($subImages), // Lưu dưới dạng JSON
             'stock' => $validated['stock'] ?? 0,
             'category_id' => $validated['category_id'],
         ]);
     
         // Lưu thuộc tính sản phẩm vào bảng product_attributes
         if ($request->input('product_type') == 1 && $request->has('attributes')) {
             foreach ($request->input('attributes') as $key => $attributeId) {
                 ProductAttribute::create([
                     'product_id' => $product->id,
                     'attribute_id' => $attributeId,
                     'attribute_values' => $request->input('attribute_values')[$key],
                 ]);
             }
         }
     
         // Xử lý biến thể sản phẩm
         if ($product->has_variants) {
             foreach ($request->input('variants', []) as $index => $variant) {
                 $imagePath = 'images/no_images.jpg'; // Sử dụng ảnh mặc định
     
                 if ($request->hasFile("variants.{$index}.main_image")) {
                     $mainImage = $request->file("variants.{$index}.main_image");
                     $imageName = time() . '_' . $mainImage->getClientOriginalName();
                     $mainImage->move(public_path('images'), $imageName);
                     $imagePath = $imageName;
                 }
     
                 // Kiểm tra và xác thực giá trị price là số hợp lệ
                 if (!is_numeric($variant['price'])) {
                     return redirect()->back()->withErrors(['price' => 'Giá của biến thể không hợp lệ.']);
                 }
     
                 $productVariant = ProductVariant::create([
                     'product_id' => $product->id,
                     'variant_name' => $variant['sku'],
                     'price' => $variant['price'],
                     'image' => $imagePath,
                     'stock' => $variant['stock'] ?? 0,
                 ]);
     
                 foreach ($variant['attributes'] as $key => $attributeId) {
                     $attribute = Attribute::find($attributeId);
                     if ($attribute) {
                         VariantAttribute::create([
                             'variant_id' => $productVariant->id,
                             'attribute_id' => (int)$attributeId,
                             'attribute_value' => $variant['attribute_values'][$key],
                         ]);
                     }
                 }
             }
         }
     
         return redirect()->route('products.index')->with('success', 'Sản phẩm được thêm thành công');
     }
     

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with(['variants.attributes.attribute', 'category'])->findOrFail($id);
        $subImagePaths = json_decode($product->sub_images, true);

        // Tính tổng số lượng và xác định giá cho từng sản phẩm
        if ($product->has_variants && $product->variants->count() > 0) {
            $prices = $product->variants->pluck('price')->unique();

            if ($prices->count() == 1) {
                $product->price_range = number_format($prices->first(), 0, ',', '.') . '₫';
            } else {
                $totalStock = $product->variants->sum('stock');
                $minPrice = $product->variants->min('price');
                $maxPrice = $product->variants->max('price');
                $product->total_stock = $totalStock;
                $product->price_range = number_format($minPrice, 0, ',', '.') . ' - ' . number_format($maxPrice, 0, ',', '.') . '₫';
            }
        } else {
            $product->total_stock = $product->stock;
            $product->price_range = number_format($product->price, 0, ',', '.') . '₫';
        }

        return view('pages.admin.products.detail', [
            'title' => 'Chi tiết sản phẩm',
            'product' => $product,
            'variations' => $product->variants,
            'subImagePaths' => $subImagePaths,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::with(['attributes.attribute', 'attributes.variantAttributes', 'variants.attributes'])->findOrFail($id);
        $attributes = Attribute::all();
        $productCategories = ProductCategory::all();
        $title = 'Chỉnh sửa sản phẩm';

        return view('pages.admin.products.edit', compact('product', 'attributes', 'productCategories', 'title'));
    }




public function update(Request $request, $id)
{
    // 1. Validate đầu vào
   
    $validated = $request->validate([
        'product_name'         => 'required|string|max:255',
        'product_description'  => 'nullable|string',
        'product_type'         => 'required|in:0,1',          // 0 = đơn, 1 = biến thể
        'product_price'        => 'required_if:product_type,0|nullable|numeric',
        'stock'                => 'required_if:product_type,0|nullable|integer',
        'category_id'          => 'required|exists:product_categories,id',
        'main_image'           => 'nullable|image',
        'sub_images.*'         => 'image',

        // Validation cho mảng variants (nếu có)
        'variants'                   => 'array',
        'variants.*.sku'             => 'required_with:variants|string',
        'variants.*.price'           => 'required_with:variants|numeric',
        'variants.*.stock'           => 'required_with:variants|integer',
        'variants.*.attributes'      => 'array',
        'variants.*.attribute_values'=> 'array',
    ]);

    DB::beginTransaction();

    try {
        /** @var \App\Models\Product $product */
        $product = Product::findOrFail($id);

        // 2. Chuẩn bị dữ liệu cập nhật cho sản phẩm cha
        $updateData = [
            'name'         => $validated['product_name'],
            'description'  => $validated['product_description'],
            'is_hot'       => $request->boolean('hot'),
            'status'       => $request->input('status', 1),
            'price'        => $validated['product_price'] ?? null,
            'stock'        => $validated['stock'] ?? null,
            'category_id'  => $validated['category_id'],
            'has_variants' => (int)$validated['product_type'] == 1,   // <-- quan trọng
        ];
        /* ----------- ẢNH CHÍNH & ẢNH PHỤ ----------- */
        if ($request->hasFile('main_image')) {
            $mainImage     = $request->file('main_image');
            $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
            $mainImage->move(public_path('images'), $mainImageName);
            $updateData['image'] = $mainImageName;
        }

        if ($request->hasFile('sub_images')) {
            $subImages = [];
            foreach ($request->file('sub_images') as $image) {
                $imageName = time() . '_' . Str::uuid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $subImages[] = $imageName;
            }
            $updateData['sub_images'] = json_encode($subImages);
        }

        // Cập nhật product
        $product->update($updateData);
   
        /* ----------- THUỘC TÍNH CỦA SẢN PHẨM CHA ----------- */
        if ($request->has('attributes')) {
            $product->attributes()->delete();   // xoá thuộc tính cũ

            $attributes       = $request->input('attributes', []);
            $attributeValues  = $request->input('attribute_values', []);

            foreach ($attributes as $k => $attributeId) {
                $value = $attributeValues[$k] ?? null;
                if ($attributeId && $value !== null) {
                    ProductAttribute::create([
                        'product_id'        => $product->id,
                        'attribute_id'      => $attributeId,
                        'attribute_values'  => is_array($value) ? json_encode($value) : $value,
                    ]);
                }
            }
        }

        /* ----------- XỬ LÝ BIẾN THỂ (nếu product_type = 1) ----------- */
        if ($validated['product_type'] == 1 && $request->filled('variants')) {

            // Xoá sạch biến thể + thuộc tính cũ
            $product->variants()->delete();

            foreach ($request->input('variants') as $idx => $variantData) {

                // Upload ảnh riêng cho biến thể (nếu có)
                $variantImage = 'images/no_images.jpg';
                if ($request->hasFile("variants.$idx.main_image")) {
                    $img       = $request->file("variants.$idx.main_image");
                    $fileName  = time() . '_' . $img->getClientOriginalName();
                    $img->move(public_path('images'), $fileName);
                    $variantImage = $fileName;
                }

                // Tạo biến thể
                $variant = ProductVariant::create([
                    'product_id'   => $product->id,
                    'variant_name' => $variantData['sku'],
                    'price'        => $variantData['price'],
                    'stock'        => $variantData['stock'] ?? 0,
                    'image'        => $variantImage,
                ]);

                // Gắn thuộc tính riêng cho biến thể
                $vAttrIds  = $variantData['attributes']       ?? [];
                $vAttrVals = $variantData['attribute_values'] ?? [];
                foreach ($vAttrIds as $k => $attrId) {
                    $val = $vAttrVals[$k] ?? null;
                    if ($attrId && $val !== null) {
                        VariantAttribute::create([
                            'variant_id'      => $variant->id,
                            'attribute_id'    => (int) $attrId,
                            'attribute_value' => is_array($val) ? json_encode($val) : $val,
                        ]);
                    }
                }
            }
        }

        DB::commit();
        return redirect()->route('products.index')
                         ->with('success', 'Sản phẩm được cập nhật thành công');
    } catch (\Throwable $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
    }
}




    // public function destroy(string $id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->delete();
    //     return redirect()->route('products.index')->with('success', 'Xóa thành công.');
    // }
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        // $list_attr = [];
        // foreach($ids as $id){
           ProductAttribute::whereIn('product_id', $ids)->delete();
        // }
        Product::whereIn('id', $ids)->delete();

        return response()->json(['success' => true]);
    }
}
