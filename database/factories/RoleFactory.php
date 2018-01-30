<?php
use Faker\Generator as Faker;

$factory->defineAs(App\Role::class, 'admin', function (Faker $faker) {
    return [
        'name' => 'Администратор',
        'slug' => 'admin'
    ];
});