<?php
namespace App\FacadesInterface;

use Illuminate\Support\Facades\Facade;

class OrderInterface extends Facade {
    protected static function getFacadeAccessor() { return 'Order'; }
}