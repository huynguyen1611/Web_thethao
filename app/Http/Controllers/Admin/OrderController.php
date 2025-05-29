<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order_list()
    {
        $orders = Order::all();
        return view('admin.order.list', [
            'orders' => $orders,
        ]);
    }
    public function order_detail(Request $request)
    {
        $order_detail = json_decode($request->order_detail, true);
        $product_id = array_keys($order_detail);
        //	Lấy danh sách ID sản phẩm cần truy vấn
        $products = Product::whereIn('id', $product_id)->get();
        //	Truy vấn sản phẩm từ DB theo ID
        return view('admin.order.detail', [
            'products' => $products,
            'order_detail' => $order_detail,
        ]);
    }
    // public function order_detail(Request $request)
    // {
    //     $discount = session('discount', 0);
    //     $total_after_discount = session('total_after_discount', 0);
    //     $order_detail = json_decode($request->order_detail, true);
    //     // Lấy cart từ session hoặc database (tuỳ bạn lưu ở đâu)
    //     $cart = session('cart', []);
    //     $products = Product::whereIn('id', array_keys($cart))->get();

    //     return view('admin.order.detail', [
    //         'cart' => $cart,
    //         'order_detail' => $order_detail,
    //         'products' => $products,
    //         'discount' => $discount,
    //         'total_after_discount' => $total_after_discount,
    //     ]);
    // }
}
