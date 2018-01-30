<?php
namespace App\Facades;

use App\Product as ProductModel;

class Product {
    public static function showInAdminCategory(ProductModel $product)
    {
        if($product->isCategory())  {
            return '<a href="'.route('admin.categories.index').'">'.$product->category->name.'</a>';
        } else {
            return trans('products.not_have_category');
        }
    }

    public static function showInAdminPrice($priceProduct) {
        return self::showPrice($priceProduct);
    }

    public static function showPrice($priceProduct) {
        return $priceProduct.trans('admin.currency');
    }

    public static function showCategory(ProductModel $product) {
        if($product->isCategory())  {
            return '<a href="'.route('public.categories.show',[$product->category]).'">'.$product->category->name.'</a>';
        } else {
            return trans('products.not_have_category');
        }
    }
}