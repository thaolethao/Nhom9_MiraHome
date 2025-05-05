<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    // Lấy danh sách sản phẩm
/*    public function getProducts()
    {
        $products = DB::table('products')->get();

        foreach ($products as $product) {
            $product->image_url = asset($product->image);
        }

        return response()->json($products);
    }
*/
public function getProducts(Request $request)
{
    $perPage = $request->input('per_page', 8); // Mặc định mỗi trang 8 sản phẩm
    $products = DB::table('products')->paginate($perPage);
    return response()->json($products);
}


    // Lấy chi tiết sản phẩm theo id
    public function getProduct($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->image_url = asset($product->image);

        return response()->json($product);
    }
    // Thêm sản phẩm mới
    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|string',
        ]);

        $id = DB::table('products')->insertGetId([
            'name' => $request->name,
            'price' => $request->price,
            'old_price' => $request->old_price ?? null,
            'image' => $request->image,
            'stock' => $request->stock ?? 100,
        ]);

        return response()->json(['message' => 'Product created', 'id' => $id], 201);
    }

    // Cập nhật toàn bộ sản phẩm (PUT)
    public function updateProduct(Request $request, $id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|string',
        ]);

        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'old_price' => $request->old_price ?? null,
            'image' => $request->image,
            'stock' => $request->stock ?? 100,
        ]);

        return response()->json(['message' => 'Product updated (full)']);
    }

    // Cập nhật một phần sản phẩm (PATCH)
    public function patchProduct(Request $request, $id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Không validate hết, chỉ validate field nào có
        $data = $request->only(['name', 'price', 'old_price', 'image', 'stock']);

        if (empty($data)) {
            return response()->json(['message' => 'No data to update'], 400);
        }

        DB::table('products')->where('id', $id)->update($data);

        return response()->json(['message' => 'Product updated (partial)']);
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        $product = DB::table('products')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        DB::table('products')->where('id', $id)->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}