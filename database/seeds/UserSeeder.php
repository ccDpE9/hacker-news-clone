<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{

    public function run()
    {

        for ($i=0; $i<30; $i++)
        {
            $faker = Faker\Factory::create();
            
            $user = new User;
            $user->name = $faker->userName;
            $user->email = $faker->email;
            $user->password = $faker->password;
            $user->save();
        }

    }
}
