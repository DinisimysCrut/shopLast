<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index',[
            'categories' => Category::with('children')->notParent()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.form',[
            'method' => 'create',
            'category' => [],
            'categories' => Category::with('children')->notParent()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->saveOne($request->all());
        return redirect()->route('admin.categories.index')->with('message',trans('admin.create_element',['name' => $category->name, 'type' => trans('categories.one')]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form',[
            'method' => 'edit',
            'category' => $category,
            'categories' => Category::with('children')->notParent()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request,Category $category)
    {
        $category->updateOne($request->all());
        return redirect()->route('admin.categories.index')->with('message',trans('admin.edit_element',['name' => $category->name, 'type' => trans('categories.one')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDestroy(Category $category) {
        return view('admin.categories.confirm_destroy',[
            'directory' => 'categories',
            'item' => $category
        ]);
    }

    public function destroy(Category $category)
    {
        $category->deleteOne();
        return redirect()->route('admin.categories.index')->with('message',trans('admin.destroy_element',['name' => $category->name, 'type' => trans('categories.one')]));
    }
}
