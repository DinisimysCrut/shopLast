<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['name' , 'parent_id'];

    public function parent() {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children() {
        return $this->hasMany(self::class,'parent_id');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function setAttributes($inputs) {
        $this->name = $inputs['name'];
    }

    public function saveOne($inputs) {
        $this->setAttributes($inputs);
        $this->setParentCategory($inputs);
        $this->save();
    }

    public function updateOne($inputs) {
        $this->setAttributes($inputs);
        if((isset($inputs['parent_id']) AND $this->isParent()) ? $inputs['parent_id'] != $this->parent->id : true) {
            $this->setParentCategory($inputs);
        }
        $this->save();

    }

    public function scopeNotParent($query) {
        return $query->where('parent_id',null);
    }

    public function setParentCategory($inputs) {
        if(isset($inputs['parent_id'])) {
            $parent=Category::find($inputs['parent_id']);
            if(count($parent)>0) {
                $this->parent()->associate($parent);
            }
        } else {
            $this->parent()->dissociate();
        }
    }

    public function getCountAllChildren() {
        $count=$this->getCountDirectChildren();
        foreach ($this->children as $child) {
            $count+=$child->getCountAllChildren();
        }
        return $count;
    }


    public function getCountDirectChildren() {
        return $this->children()->count();
    }

    public function getCountProducts() {
        return $this->products()->count();
    }

    public function deleteOne() {
        foreach ($this->children as $child) {
            if($this->isParent()) {
                $child->parent()->associate($this->parent);
            } else {
                $child->parent()->dissociate();
            }
        }
        foreach ($this->products as $product) {
            $product->category()->dissociate();
        }
        $this->push();
        $this->delete();
    }

    public function isParent() {
        return isset($this->parent);
    }

}
