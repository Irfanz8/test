<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('EN');

        for($x = 1; $x <= 10; $x++){
 
        	// insert data dummy data companiy
        	DB::table('companies')->insert([
        		'name' => $faker->company,
        	]);
 
        }
    }
}
