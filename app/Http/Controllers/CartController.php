<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        return view('home.cart');
    }

    public function add(Product $product, Request $req) {

        $quantity = $req->quantity ? floor($req->quantity) : 1;

        $cus_id = auth('cus')->id();

        $cartExist = Cart::where([
            'customer_id' => $cus_id,
            'product_id' => $product->id 
        ])->first();
        
        if ($cartExist) {
            Cart::where([
                'customer_id' => $cus_id,
                'product_id' => $product->id 
            ])->increment('quantity', $quantity);
            return response()->json(['success' => true, 'message' => 'Update product quantity in cart successfully']);
        } else {
            $data = [
                'customer_id' => auth('cus')->id(),
                'product_id' => $product->id,
                'price' => $product->sale_price ? $product->sale_price : $product->price,
                'quantity' => $quantity
            ];

            if (Cart::create($data)) {
                return response()->json(['success' => true, 'message' => 'Add product to cart successfully']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something error, please try again']);
    }

    public function update(Product $product, Request $req) {
        $quantity = $req->quantity ? floor($req->quantity) : 1;

        $cus_id = auth('cus')->id();

        $cartExist = Cart::where([
            'customer_id' => $cus_id,
            'product_id' => $product->id 
        ])->first();

        if ($cartExist) {
    
            Cart::where([
                'customer_id' => $cus_id,
                'product_id' => $product->id 
            ])->update([
                'quantity' => $quantity
            ]);

            return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
        } 

        return response()->json(['success' => false, 'message' => 'error']);
    }

    public function delete($product_id) {
        $cus_id = auth('cus')->id();
        Cart::where([
            'customer_id' => $cus_id,
            'product_id' => $product_id
        ])->delete();
        return response()->json(['success' => true, 'message' => 'Deleted product in shopping cart']);
    }

    public function clear() {
        $cus_id = auth('cus')->id();
        Cart::where([
            'customer_id' => $cus_id
        ])->delete();

        return redirect()->back()->with('ok','Deleted all product in shopping cart');
    }
}
