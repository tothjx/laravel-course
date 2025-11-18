<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderPlaced;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'A kosár üres!');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'A kosár üres!');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'billing_address' => 'required|string|max:255',
            'billing_city' => 'required|string|max:100',
            'billing_zip' => 'required|string|max:10',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:10',
            'shipping_method' => 'required|in:házhoz szállítás,boltban átvétel',
            'payment_method' => 'required|in:készpénz,bankkártya',
        ]);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'billing_address' => $validated['billing_address'],
            'billing_city' => $validated['billing_city'],
            'billing_zip' => $validated['billing_zip'],
            'shipping_address' => $validated['shipping_address'],
            'shipping_city' => $validated['shipping_city'],
            'shipping_zip' => $validated['shipping_zip'],
            'shipping_method' => $validated['shipping_method'],
            'payment_method' => $validated['payment_method'],
            'total_amount' => $total,
            'items' => $cart,
            'status' => 'pending',
        ]);

        // Send notification to all admin users
        $admins = User::all();
        foreach ($admins as $admin) {
            $admin->notify(new OrderPlaced($order));
        }

        session()->forget('cart');

        return redirect()->route('order.success', $order->id);
    }

    public function success($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.success', compact('order'));
    }
}
