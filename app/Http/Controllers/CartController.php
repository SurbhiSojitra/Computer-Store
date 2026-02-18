<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $quantity = $request->quantity ?? 1;

        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available!');
        }

        $price = $product->price;
        $subtotal = $price * $quantity;

        Cart::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $subtotal,
        ]);

        return redirect()->route('cart.page')->with('success', 'Product added to cart!');
    }

    public function cartPage()
    {
        $cartItems = Cart::with('product')->get();

        $total = $cartItems->sum('subtotal');

        return view('cart', compact('cartItems', 'total'));
    }

    public function delete($id)
    {
        Cart::findOrFail($id)->delete();

        return back()->with('success', 'Item removed from cart!');
    }

    public function update(Request $request)
    {
        foreach ($request->quantities as $cartId => $qty) {

            $cart = Cart::with('product')->find($cartId);

            if ($cart) {
                if ($qty > $cart->product->stock) {
                    return back()->with('error', 'Quantity exceeds available stock!');
                }
                $cart->quantity = $qty;
                $cart->subtotal = $cart->price * $qty;
                $cart->save();
            }
        }

        return redirect()->route('cart.page')->with('success', 'Cart updated successfully!');
    }

    public function checkout()
    {
        $cartItems = Cart::with('product')->get();
        $total = $cartItems->sum('subtotal');

        return view('checkout', compact('cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cartItems = Cart::with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with('error', $item->product->name . ' does not have enough stock.');
            }
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total_price' => $cartItems->sum('subtotal'),
        ]);
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
            ]);

            $item->product->stock -= $item->quantity;
            $item->product->save();
        }

        Cart::truncate();

        return redirect()->route('order.success', $order->id);
    }

    public function orderSuccess(Order $order)
    {
        $order->load('items.product');
        return view('ordersuccess', compact('order'));
    }

    public function orders()
    {
        $orders = Order::with('user')->orderBy('id', 'DESC')->get();

        return view('admin.orders', compact('orders'));
    }
}
