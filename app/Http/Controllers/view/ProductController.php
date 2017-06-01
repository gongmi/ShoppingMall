<?php

namespace App\Http\Controllers\view;

use App\Entity\PdtContent;
use App\Entity\PdtImage;
use App\Entity\Product;
use App\Http\Controllers\Controller;
use \App\Http\Controllers\Service\CartController;

class ProductController extends Controller
{

    public function show($id)
    {
        $pdt_content = PdtContent::where('product_id', $id)->first();
        $product = Product::Find($id);
        $pdt_images = PdtImage::where('product_id', $id)->get();
        $count = CartController::count();
        return view('pdt_content')->with('product', $product)
            ->with('pdt_content', $pdt_content)
            ->with('count', $count)
            ->with('pdt_images', $pdt_images);
    }
}
