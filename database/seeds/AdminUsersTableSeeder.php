<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,'admin',1)->make()->each(function ($user) {
            $user->role()->associate(factory(App\Role::class,'admin')->create());
            $user->save();
        });
    }
}
