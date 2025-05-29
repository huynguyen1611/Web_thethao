<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function insert_product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp',
        ]);
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:1024',  // Kiểm tra ảnh và kích thước tối đa 1MB
        //     'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:1024',  // Kiểm tra nhiều ảnh và kích thước tối đa 1MB
        // ], [
        //     'image.required' => 'Vui lòng chọn ảnh đại diện',
        //     'image.image' => 'Tệp tin phải là ảnh',
        //     'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc webp',
        //     'image.max' => 'Ảnh không được vượt quá 1MB',
        //     'images.*.image' => 'Mỗi tệp tin phải là ảnh',
        //     'images.*.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc webp',
        //     'images.*.max' => 'Mỗi ảnh không được vượt quá 1MB',
        // ]);
        $product = new Product();
        $product->name = $request->input('name');
        $product->material = $request->input('material');
        $product->price_nomal = $request->input('price_nomal');
        $product->price_sale = $request->input('price_sale');
        $product->description = $request->input('description');
        $product->content = $request->input('content');
        // Lưu ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $timestamp = time();  // Lấy thời gian hiện tại
            $fileName = $timestamp . '-' . $file->getClientOriginalName();
            $file->storeAs('images', $fileName, 'public');
            $product->image = '/storage/images/' . $fileName;
        }
        // Lưu nhiều ảnh
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $paths = [];
            $timestamp = time();  // Lấy thời gian hiện tại cho mỗi ảnh
            foreach ($images as $img) {
                $fileName = $timestamp . '-' . $img->getClientOriginalName();
                $img->storeAs('images', $fileName, 'public');
                $paths[] = '/storage/images/' . $fileName;
            }
            // Lưu dưới dạng chuỗi phân cách *
            $product->images = implode('*', $paths);
        }
        $product->save();
        return redirect()->back()->with('success', 'Thêm sản phẩm thành công!');
    }
    public function add_product(Request $request)
    {
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm'
        ]);
    }
    public function list_product(Request $request)
    {
        $product = Product::all(); //lấy tất cả sản phẩm từ model
        //$product = Product::skip(0)->take(3)->get(); //lấy 3 sản phẩm đầu tiên
        //$product = Product::paginate(3); // phân trang 3 sản phẩm 1 trang
        //$product = Product::orderBy('id', 'desc')->paginate(3); // phân trang 3 sản phẩm 1 trang theo id giảm dần
        //$product = Product::orderBy('id', 'asc')->paginate(3); // phân trang 3 sản phẩm 1 trang theo id tăng dần
        //$product = DB::table('product') ->paginate(3); //lấy 3 sản phẩm đầu tiên
        return view('admin.product.list', [
            'title' => 'Danh sách sản phẩm',
            'products' => $product
        ]);
    }
    public function delete_product(Request $request)
    {
        $product = Product::find($request->product_id);
        if ($product) {
            $product->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
    }
    public function edit_product(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            return view('admin.product.edit', [
                'title' => 'Chỉnh sửa sản phẩm',
                'product' => $product
            ]);
        }
        return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
    }
    public function update_product(Request $request)
    {
        $product = Product::find($request->id);
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }

        // Cập nhật thông tin sản phẩm từ request
        $product->name = $request->name;
        $product->material = $request->material;
        $product->price_nomal = $request->price_nomal;
        $product->price_sale = $request->price_sale;
        $product->description = $request->description;
        $product->content = $request->content;

        // Xử lý upload ảnh đại diện (nếu có)
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads', 'public');
            $product->image = '/storage/' . $image;
        }

        // Xử lý upload ảnh sản phẩm (nếu có)
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $img) {
                $path = $img->store('uploads', 'public');
                $imagePaths[] = '/storage/' . $path;
            }
            $product->images = implode('*', $imagePaths); // Lưu chuỗi ảnh cách nhau bằng *
        }

        $product->save();

        return redirect()->route('admin.product.list', $product->id)->with('success', 'Cập nhật thành công!');
    }
}
