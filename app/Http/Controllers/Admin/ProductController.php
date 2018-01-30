<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index',[
            'products' => Product::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.form',[
            'method' => 'create',
            'categories' => Category::doesntHave('children')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product=new Product;
        $product->createOne($request->all());
        return redirect()->route('admin.products.index')->with('message',trans('admin.create_element',['name' => $product->name, 'type' => trans('products.one')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.form',[
            'product' => $product,
            'method' => 'edit',
            'categories' =>  Category::doesntHave('children')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->updateOne($request->all());
        return redirect()->route('admin.products.index')->with('message',trans('admin.edit_element',['name' => $product->name, 'type' => trans('products.one')]));

    }


    public function confirmDestroy(Product $product) {
        return view('admin.products.confirm_destroy',[
            'directory' => 'products',
            'item' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->deleteOne();
        return redirect()->route('admin.products.index')->with('message',trans('admin.destroy_element',['name' => $product->name, 'type' => trans('products.one')]));

    }
}
