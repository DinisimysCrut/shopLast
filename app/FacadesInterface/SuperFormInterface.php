<?php
namespace App\FacadesInterface;

use Illuminate\Support\Facades\Facade;

class SuperFormInterface extends Facade {
    protected static function getFacadeAccessor() { return 'SuperForm'; }
}