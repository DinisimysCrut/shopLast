<?php
namespace App\Facades;

use App\Product as ProductModel;
use App\Facades\Product as Product;

class Basket {

    public static function all() {
        $basket=self::getSession();
        $all=[];
        foreach ($basket as $id=>$item) {
            $product=ProductModel::find($id);
            if(!isset($product)) continue;
            $all[]=[
                'product'=>$product,
                'count'=>$item['count'],
                'price'=>$item['price']
            ];
        }
        return $all;
    }



    public static function price(){
        $price=0;
        foreach (self::getSession() as $product) {
            $price+=$product['price']*$product['count'];
        }
        return Product::showPrice($price);
    }

    public static function getSession() {
        return session('basket') ? session('basket') : [];
    }

    public static function addProduct($product,$count) {
        $basket=self::getSession();
        $basket[$product->id]=['count'=>$count,'price'=>$product->price];
        self::setSession($basket);
    }


    public static function setSession($basket) {
        session(['basket'=>$basket]);
    }

    public static function has($productId) {
        return key_exists($productId,self::getSession());
    }

    public static function deleteProduct($productId) {
        $basket=self::getSession();
        if(self::has($productId)) {
            unset($basket[$productId]);
            self::setSession($basket);
            return true;
        }
        return false;
    }

    public static function is() {
        return count(self::getSession())>0;
    }

    public static function clear() {
        session()->forget('basket');
    }

}