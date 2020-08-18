<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('EN');

        for($x = 1; $x <= 50; $x++){
 
        	// insert data dummy data event
        	DB::table('events')->insert([
        		'name' => $faker->jobTitle ,
        	]);
 
        }
    }
}
