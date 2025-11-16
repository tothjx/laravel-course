<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Nincs készleten!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $product->stock) {
                return redirect()->back()->with('error', 'Nincs több készleten!');
            }
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // ez félmegoldás, de ezt kérted a specifikációban
        // és érthető is egy nagyobb forgalmú webshop esetén
        // ha nem rendeli meg, akkor a session lejártakor kerül vissza
        // ha kiveszi, akkor pedig rögtön visszakerül
        $product->decrement('stock');
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Termék hozzáadva a kosárhoz!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($id);

        if (!isset($cart[$id])) {
            return redirect()->back();
        }

        $action = $request->input('action');

        if ($action === 'increase') {
            if ($product->stock <= 0) {
                return redirect()->back()->with('error', 'Nincs több készleten!');
            }
            $cart[$id]['quantity']++;
            $product->decrement('stock');
        } elseif ($action === 'decrease') {
            $cart[$id]['quantity']--;
            $product->increment('stock');

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        $product = Product::findOrFail($id);

        if (isset($cart[$id])) {
            $product->increment('stock', $cart[$id]['quantity']);
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Termék eltávolítva!');
    }
}
