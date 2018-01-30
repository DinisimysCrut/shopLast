<?php

namespace App\Facades;
use Form;

class SuperForm {
    public static function deleteForm($routeName,$data) {
        return Form::open(route($routeName,$data),'delete').Form::submit(trans('submit.delete')).Form::close();
    }

    public static function confirmDeleteButton($routeName,$data) {
        return '<a href="'. route($routeName,$data).'"><button>'.trans('submit.delete').'</button></a>';
    }
}