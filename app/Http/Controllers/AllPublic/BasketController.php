<?php

namespace App\Http\Controllers\AllPublic;

use App\Facades\Basket;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountProductRequest;
use App\Product;

class BasketController extends Controller
{


    public function show(Product $product=null)
    {
        return view('public.basket.show',['product'=>$product]);
    }

    public function store(CountProductRequest $request, Product $product)
    {
        $status=Basket::has($product->id)?'update':'create';
        Basket::addProduct($product,$request->count);
        return redirect()->route('public.products.show',[$product])->with('productAddBasket',['count'=>$request->count,'name'=>$product->name,'status'=>$status]);
    }

    public function destroy(Product $product) {
        $deleted=Basket::deleteProduct($product->id);
        return redirect()->route('public.products.show',[$product])->with('productDeletedBasket',$deleted);

    }


}
