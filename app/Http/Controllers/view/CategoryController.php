<?php

namespace App\Http\Controllers\view;

use App\Entity\Category;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
        Log::info("进入书籍类别");
        return view('category')->with('categories', $categories);
    }

    public function show($cate_id)
    {
        $products = Product::where('category_id', $cate_id)->get();
        return view('product')->with('products', $products);
    }
}
