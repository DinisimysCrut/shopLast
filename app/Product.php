<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    public $fillable = ['name' , 'about' , 'price', 'category_id'];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function images() {
        return Storage::files('images/products/'.$this->id);
    }

    public function saveOne($inputs) {
        $this->name=$inputs['name'];
        $this->about=$inputs['about'];
        $this->price=$inputs['price'];
        $this->setCategory($inputs);
        $this->save();
        if(isset($inputs['images'])) {
            $this->downloadImages($inputs['images']);
        }
    }

    public function createOne($inputs) {
        $this->makeDirectoryImages();
        $this->saveOne($inputs);
    }

    public function updateOne($inputs) {
        $this->saveOne($inputs);
        if(isset($inputs['imagesDelete'])) {
            $this->deleteImages($inputs['imagesDelete']);
        }
    }

    public function downloadImages($requestImages) {
        if(count($requestImages)>0) {
            foreach ($requestImages as $image) {
                $image->store('images/products/'.$this->id);
            }
        }
    }

    public function makeDirectoryImages() {
        Storage::makeDirectory('images/products/'.$this->id);
    }

    public function deleteImages($requestImagesDelete) {
        if(count($requestImagesDelete)>0) {
            Storage::delete($requestImagesDelete);
        }
    }

    public function setCategory($inputs) {
        if(isset($inputs['category_id'])) {
            $category=Category::find($inputs['category_id']);
            if(count($category)>0) {
                $this->category()->associate($category);
            }
        } else {
            $this->category()->dissociate();
        }
    }

    public function deleteOne() {
        Storage::deleteDirectory('images/products/'.$this->id);
        $this->delete();
    }

    public function isCategory() {
        return isset($this->category);
    }
}
