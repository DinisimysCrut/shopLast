<?php
namespace App\FacadesInterface;

use Illuminate\Support\Facades\Facade;

class BasketInterface extends Facade {
    protected static function getFacadeAccessor() { return 'Basket'; }
}