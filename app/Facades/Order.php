<?php
namespace App\Facades;

use App\Order as ModelOrder;
use Form;
use Product;

class Order {

    public static function allTextStatus() {
        return ['processing','building'];
    }

    public static function countByStatus($status) {
        return ModelOrder::where('status',$status)->count();
    }

    public static function showNameProduct($nameProduct,$idProduct) {
        return '<b>'.trans('products.name').' <a href="'.route('public.products.show',['product'=>$idProduct]).'">'.$nameProduct.'</a></b>';
    }

    public static function showPriceOneProduct($price) {
        return  trans('products.price_one').': '.Product::showPrice($price);
    }

    public static function showTotalPriceProduct($price,$count) {
        return  trans('products.total_price').': '.Product::showPrice($price*$count);
    }

    public static function showCountProduct($count) {
        return trans('products.count').': '.$count;
    }

    public static function showCreateDate($createAt) {
        return trans('orders.created_at').': '.$createAt;
    }

    public static function showFormEditCountProduct($routeName,$lastCount=0,$data) {
        return '<form action="'.route($routeName,$data).'" method="post">
        '.trans('products.count').': <input type="number" name="count" value="'.$lastCount.'" min="1">'.csrf_field().method_field('PUT').'
        <input type="submit" value="'.trans('submit.edit').'">
        </form>';
    }
}
