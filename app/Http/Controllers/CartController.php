<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id); // Fetch the product

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()], // Ensure there's a cart for the user
            ['user_id' => Auth::id()]
        );

        $cartItem = CartItem::where('product_id', $product->id)
                            ->where('cart_id', $cart->id)
                            ->first();

        if ($cartItem) {
            // Increment quantity if item already exists
            $cartItem->increment('quantity', $request->quantity);
            $cartItem->price = $product->price; // Update the price in case it has changed
            $cartItem->save();
        } else {
            // Create a new cart item if it doesn't exist
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price // Use the price from the Product model
            ]);
        }

        return redirect('/cart')->with('success', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        $cart = Cart::with('cartItems.product')->where('user_id', Auth::id())->firstOrFail();
        $cart_items = $cart->cartItems;
        if ($cart_items->isEmpty()) {
            return redirect('dashboard')->with('alert', '您的購物車沒有商品');
        }
        return view('cart.cart', compact('cart_items'));
    }
}
