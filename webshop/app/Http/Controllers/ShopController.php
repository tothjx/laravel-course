<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shop.index', compact('categories', 'products'));
    }

    public function category($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with('category')
            ->where('category_id', $category->id)
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shop.index', compact('categories', 'products', 'category'));
    }
}
