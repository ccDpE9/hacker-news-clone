<?php


use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{

    public function run()
    {
        factory('App\User', 50)->create()->each(function ($user) {
            $user->links()->save(factory('App\Link')->make());
        });
    }

}

