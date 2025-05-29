<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\TestMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;
use App\Mail\AdminOrderMail;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class Frontendcontroller extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(5)->get(); // hoặc filter is_hot nếu có
        $newProducts = Product::orderBy('id', 'desc')->take(5)->get(); // sản phẩm mới nhất

        return view('home', [
            'products' => $products,
            'newProducts' => $newProducts,
        ]);
    }
    public function show_product(Request $request)
    {
        $products = Product::inRandomOrder()->take(5)->get(); // hoặc filter is_hot nếu có
        $newProducts = Product::orderBy('id', 'desc')->take(5)->get(); // sản phẩm mới nhất

        $product = Product::find($request->id);
        return view('frontend.product', [
            'product' => $product,
            'products' => $products,
            'newProducts' => $newProducts,
            'listImages' => explode('*', $product->images), // Chia chuỗi thành mảng
        ]);
    }
    public function add_cart(Request $request)
    {

        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if (is_null(Session()->get('cart'))) {
            Session()->put('cart', [
                $product_id => $product_qty,
            ]);
            // return redirect('/frontend/cart');
        } else {
            $cart = Session()->get('cart', []);
            if (Arr::exists($cart, $product_id)) {
                $cart[$product_id] = $cart[$product_id] + $product_qty;
                Session()->put('cart', $cart);
                // return redirect('/frontend/cart');
            } else {
                $cart[$product_id] = $product_qty;
                Session()->put('cart', $cart);
                // return redirect('/frontend/cart');
            }
        }

        $carts = Session()->get('cart');
        // $countQty = count($carts) > 0 ? array_sum($carts) : 0;

        return response()->json([
            'success' => true,
            'cart_count' => count($carts)
        ]);
    }

    function cart_update_ajax(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        $cart = Session()->get('cart', []);

        $product = Product::select('id', 'price_sale')->where('id', $product_id)->first();
        if (!empty($product) && Arr::exists($cart, $product_id)) {
            $cart[$product_id] = $product_qty;
            Session()->put('cart', $cart);

            $total = $cart[$product_id] * $product->price_sale;

            return response()->json([
                'success' => true,
                'price' => $total,
                'price_number' => number_format($total, '0', ',', '.'),
            ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }
    public function show_cart()
    {
        // $cart = Session()->get('cart', []); // trả về mảng rỗng nếu chưa có
        // $product_id = array_keys($cart); //lấy ra id sản phẩm trong giỏ hàng
        // $products = Product::whereIn('id', $product_id)->get(); //lấy ra sản phẩm trong giỏ hàng
        // return view('frontend.cart', [
        //     'products' => $products,
        //     // 'cart' => $cart,
        // ]);
        $cart = Session()->get('cart', []); // luôn là mảng
        // Nếu giỏ hàng rỗng
        if (empty($cart)) {
            return view('frontend.cart', [
                'products' => [],
                'message' => 'Không có sản phẩm trong giỏ hàng',
            ]);
        }
        $product_id = array_keys($cart); // lấy ID sản phẩm
        $products = Product::whereIn('id', $product_id)->get(); // lấy sản phẩm
        return view('frontend.cart', [
            'products' => $products,
            'message' => null
        ]);
        //bổ sung
        $total = 0;
        foreach ($products as $product) {
            $total += $product->price_sale * $cart[$product->id];
        }

        $discount = 0;
        $voucher = session('voucher');
        if ($voucher) {
            $discount = $voucher['discount'];
        }

        return view('frontend.cart', [
            'products' => $products,
            'message' => null,
            'total' => $total,
            'discount' => $discount,
            'total_after_discount' => $total - $discount,
        ]);
    }
    public function cart_delete(Request $request)
    {
        $cart = Session()->get('cart', []); // Đảm bảo $cart luôn là array
        $product_id = $request->id;
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]); // Chỉ xóa nếu tồn tại
            Session()->put('cart', $cart);
        }
        return redirect('/frontend/cart');
    }
    public function cart_update(Request $request)
    {
        $cart = $request->product_id;
        Session()->put('cart', $cart);
        return redirect('/frontend/cart');
        // return response()->json([
        //     'success' => true,

        // ]);
    }
    public function cart_send(OrderRequest $request)
    {
        $token = Str::random(12);
        $order = new Order();
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->city = $request->input('city');
        $order->district = $request->input('district');
        $order->ward = $request->input('ward');
        $order->address = $request->input('address');
        $order->note = $request->input('note');
        //$order_detail = emplode('*',$request->input('product_id'));
        $order_detail = json_encode($request->input('product_id'));
        $order->order_detail = $order_detail;
        $order->token = $token;
        //bổ sung
        // $voucher = session('voucher');
        // $discount = $voucher['discount'] ?? 0;
        // $order->discount = $discount; // nếu bảng orders có cột `discount`
        //
        $order->save(); // => Tự động tạo $order->id
        Session()->flush('cart');
        $Mailinfo = $order->email;
        $Nameinfo = $order->name;
        //gửi mail cho khách hàng và lấy ra tên người dùng
        $Mail = Mail::to($Mailinfo)->send(new TestMail($Nameinfo));

        //gửi mail cho admin
        // $order->email = '21t1020425@husc.edu.vn';
        // Notification::send($order, new EmailNotification($order));
        $MailAdmin = env('MAIL_FROM_ADDRESS', '21t1020425@husc.edu.vn');
        Mail::to($MailAdmin)->send(new AdminOrderMail($order));
        //chuyển hướng sang order_check kèm theo id
        return redirect('/frontend/order/order_check/' . $order->id);
        //bổ sung
        // Session()->forget('voucher');
    }
    public function order_check($id)
    {
        $order = Order::findOrFail($id);
        return view('frontend.order.order_check', [
            'order' => $order,
        ]);
    }
    // public function order_check()
    // {
    //     $orders = Order::pluck('name', 'id'); // sẽ trả về Collection kiểu [id => name]
    //     return view('frontend.order.order_check', [
    //         'orders' => $orders,
    //     ]);
    // }
    // Trang đăng nhập
    public function login()
    {
        return view('frontend.accout.login');
    }

    public function check_login(Request $request)
    {

        if (Auth::guard('customer')->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])) {
            return redirect('/')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->back()->withErrors([
            'login' => 'Email hoặc mật khẩu không đúng',
        ])->withInput();
    }
    //logout
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('account_login');
    }
    // Trang đăng ký
    public function show()
    {
        return view('frontend.accout.register');
    }

    // Xử lý đăng ký
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:3|confirmed',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'city.required' => 'Vui lòng chọn tỉnh/thành phố.',
            'district.required' => 'Vui lòng chọn quận/huyện.',
            'ward.required' => 'Vui lòng chọn phường/xã.',
            'address.required' => 'Vui lòng nhập địa chỉ.',

            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.min' => 'Mật khẩu phải ít nhất 3 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);
        Customer::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'city' => $request->input('city'),
            'district' => $request->input('district'),
            'ward' => $request->input('ward'),
            'address' => $request->input('address'),
        ]);

        return redirect('/account/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    public function edit_user()
    {
        $customer = Auth::guard('customer')->user(); // Lấy thông tin khách hàng đã đăng nhập
        if ($customer) {
            return view('frontend.accout.edit_user', [
                'customer' => $customer
            ]);
        }
        return redirect()->route('account_login')->with('error', 'Vui lòng đăng nhập');
    }
    public function update_user(Request $request)
    {
        /** @var \App\Models\Customer $customer */
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->route('account_login')->with('error', 'Vui lòng đăng nhập');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|min:3|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'name.string' => 'Tên không hợp lệ',
            'name.max' => 'Tên không được vượt quá 255 ký tự',

            'phone.required' => 'Vui lòng nhập số điện thoại',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',

            'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp',
        ]);

        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->city = $request->city;
        $customer->district = $request->district;
        $customer->ward = $request->ward;
        $customer->address = $request->address;

        if ($request->password) {
            $customer->password = bcrypt($request->password);
        }
        $customer->password = Hash::make($request->password);
        $customer->save();

        return redirect()->route('edit_user')->with('success', 'Cập nhật thành công!');
    }
    // voucher
    public function applyVoucher(Request $request)
    {
        $code = $request->input('voucher_code');
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $total = 0;
        foreach ($products as $product) {
            $total += $product->price_sale * $cart[$product->id];
        }

        // Danh sách mã
        $vouchers = [
            'GIAM50K' => ['type' => 'fixed', 'value' => 50000],
            'GIAM10%' => ['type' => 'percent', 'value' => 10],
            'GIAM10%MAX50K' => ['type' => 'percent', 'value' => 10, 'max' => 50000],
            'GIAM100K' => ['type' => 'fixed', 'value' => 100000],
        ];

        // Không tồn tại mã
        if (!isset($vouchers[$code])) {
            return response()->json(['success' => false, 'message' => 'Mã không hợp lệ!']);
        }

        $voucher = $vouchers[$code];
        $discount = 0;

        switch ($voucher['type']) {
            case 'fixed':
                $discount = $voucher['value'];
                break;
            case 'percent':
                $discount = ($voucher['value'] / 100) * $total;
                if (isset($voucher['max'])) {
                    $discount = min($discount, $voucher['max']);
                }
                break;
            case 'max_discount':
                $discount = min($voucher['value'], $voucher['max']);
                break;
        }

        $discount = min($discount, $total); // Không để giảm vượt quá tổng

        // ✅ Lưu cả mã, tổng, giảm và tổng sau giảm
        session()->put('voucher', [
            'code' => $code,
            'discount' => $discount,
            'total' => $total,
            'total_after_discount' => $total - $discount
        ]);
        session()->put('discount', $discount);
        session()->put('total_after_discount', $total - $discount);
        return response()->json([
            'success' => true,
            'discount' => $discount,
            'total_after_discount' => $total - $discount,
            'message' => 'Áp dụng mã thành công!'
        ]);
    }
}
