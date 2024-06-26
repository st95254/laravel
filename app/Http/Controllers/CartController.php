<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\History;
use App\Models\HistoryItem;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // 檢查用戶是否登入
        if (!Auth::check()) {
            return redirect('/login')->with('alert', '請先登入會員！');
        }

        $product = Product::findOrFail($request->product_id); // Fetch the product

        $cart = Cart::firstOrCreate(
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
        $user = auth()->user();
        $cart = Cart::with('cartItems.product')->where('user_id', Auth::id())->first();

        if (!$cart) {
            // 購物車不存在，創建一個新的空購物車或顯示適當的消息
            return redirect('dashboard')->with('alert', '您的購物車是空的！');
        }

        $cart_items = $cart->cartItems;
        if ($cart_items->isEmpty()) {
            return redirect('dashboard')->with('alert', '您的購物車是空的！');
        }

        return view('cart.cart', compact('user', 'cart_items'));
    }

    public function updateCart(Request $request)
    {
        $cartItem = CartItem::find($request->input('item_id'));
        if (!$cartItem) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        if ($request->input('action') === 'delete') {
            $cartItem->delete();
        } else {
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();
        }

        return response()->json(['success' => true]);
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        // Validate request data
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|regex:/^\d{8,15}$/',
            'address' => 'required|string|max:100',
            'account' => 'required|regex:/^\d{5}$/',
            'totalInput' => 'required|integer',
            'shippingFeeInput' => 'required|integer',
            'orderStatusInput' => 'required|string'
        ]);

        // Create a history record
        $history = History::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'account' => $validated['account'],
            'remark' => $request->input('remark', ''),
            'trade_no' => now()->format('YmdHis') . $user->id,
            'total' => $validated['totalInput'],
            'date' => now(),
            'shipping_fee' => $validated['shippingFeeInput'],
            'status' => $validated['orderStatusInput']
        ]);

        $cartItems = $user->cart->cartItems;

        foreach ($cartItems as $item) {
            HistoryItem::create([
                'history_id' => $history->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        // Clear cart after checkout
        $user->cartItems()->delete();

        return redirect()->route('checkout.complete')->with('success', 'Order successfully placed!');
    }
}
