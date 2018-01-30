<?php

namespace App\Http\Controllers\AllPublic;

use App\Http\Controllers\Controller;
use App\Product;


class ProductController extends Controller
{
    public  function show(Product $product) {
        return view('public.products.show',['product' => $product]);

    }
}
