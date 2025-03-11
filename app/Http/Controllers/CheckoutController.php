<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Mail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $auth = auth('cus')->user();
        return view('home.checkout', compact('auth'));
    }
    public function history()
    {
        $auth = auth('cus')->user();
        return view('home.history', compact('auth'));
    }
    public function detail(Order $order)
    {
        $auth = auth('cus')->user();
        return view('home.detail', compact('auth', 'order'));
    }

    public function post_checkout(Request $req)
    {
        $auth = auth('cus')->user();

        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:9|max:11',
            'address' => 'required',
        ]);

        $data = $req->only('name', 'email', 'phone', 'address', 'payment_method', 'transactionId');
        $data['customer_id'] = $auth->id;
        $data['status'] = 0;
        $data['created_at'] = date('Y-m-d H:i:s'); // Định dạng chuẩn của MySQL
        
        if ($order = Order::create($data)) {
            $token = Str::random(40);

            foreach ($auth->carts as $cart) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity
                ]);
            }

            $order->token = $token;
            $order->save();

            Mail::to($auth->email)->send(new OrderMail($order, $token));

            // Nếu là COD, xóa giỏ hàng ngay
            if ($req->payment_method == 0) {
                //xoas gio hang
                $cus_id = auth('cus')->id();
                Cart::where([
                    'customer_id' => $cus_id
                ])->delete();
                return redirect()->route('home.index')->with('ok', 'Order checkout successfully');
            }
            if ($req->check_payment_method == 1 && $req->payment_method == 1) {
                //xoas gio hang
                $cus_id = auth('cus')->id();
                Cart::where([
                    'customer_id' => $cus_id
                ])->delete();
                return redirect()->route('home.index')->with('ok', 'Order checkout successfully');
            }
        }
        return redirect()->route('home.index')->with('no', 'Something error, please try again');
    }

    public function verify($token)
    {
        $order = Order::where('token', $token)->first();
        if ($order) {
            $order->token = null;
            $order->status = 1;
            $order->save();
            return redirect()->route('home.index')->with('ok', 'Order verify successfully');
        }

        return abort(404);
    }
}
