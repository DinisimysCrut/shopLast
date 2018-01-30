<?php

namespace App\Http\Controllers\AllPublic;

use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function index() {
        return view('public.categories.index',[
            'category' => [],
            'categories' => Category::notParent()->paginate(10)
        ]);
    }

    public function show(Category $category) {
        if($category->children()->count()>0) {
            return view('public.categories.index',[
                'category' => $category,
                'categories' => $category->children()->paginate(10)
            ]);
        } else {
            return view('public.categories.show',[
                'category' => $category,
                'products' => $category->products()->paginate(10)
            ]);
        }
    }

}
