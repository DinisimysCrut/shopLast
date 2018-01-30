<?php
namespace App\FacadesInterface;

use Illuminate\Support\Facades\Facade;

class ProductInterface extends Facade {
    protected static function getFacadeAccessor() { return 'Product'; }
}