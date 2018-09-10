<?php

use Illuminate\Database\Seeder;
use App\Link;
use App\User;

class LinkSeeder extends Seeder
{
    public function run()
    {

        DB::table('links')->delete();

        for ($i=0; $i<100; $i++) {
            $faker = Faker\Factory::create();

            $random_user_id = User::all()->random(1)[0]->id;

            $link = new Link;
            $link->title = $faker->title;
            $link->url = $faker->url;
            $link->description = $faker->text;
            $link->user_id = $random_user_id;

            $link->save(); 
        }
    }
}
