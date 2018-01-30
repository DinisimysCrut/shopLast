<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends Model
{

    protected $casts = [
        'prices' => 'array'
    ];



    public function products() {
        return $this->belongsToMany('App\Product')->withPivot('count', 'price');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function createOne($products,$inputs) {
        $this->phone=$inputs['phone'];
        $this->user()->associate(Auth::user());
        $this->save();
        $this->products()->attach($products);
    }

    public function price() {
        $price=0;
        foreach ($this->products as $product) {
            $price+=$product->pivot->count*$product->pivot->price;
        }
        return $price;
    }

    public function updateProduct($request,$product) {
        $this->products()->updateExistingPivot($product->id,['count'=>$request->count]);
    }

    public function deleteProduct($product) {
        $this->products()->detach($product->id);
    }

    public function deleteOne()
    {
        $this->products()->detach();
        $this->delete();
    }
}
