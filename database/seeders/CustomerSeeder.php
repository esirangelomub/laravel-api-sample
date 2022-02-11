<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        Customer::truncate();

        $faker = \Faker\Factory::create();

        Customer::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'address' => [
                'number' => $faker->numberBetween([10, 999]),
                'street_name' => $faker->streetName,
                'city' => $faker->city,
                'state' => $faker->locale,
                'country' => $faker->country
            ]
        ]);

        for ($i = 0; $i < 10; $i++) {
            Customer::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => [
                    'number' => $faker->numberBetween([10, 999]),
                    'street_name' => $faker->streetName,
                    'city' => $faker->city,
                    'state' => $faker->locale,
                    'country' => $faker->country
                ]
            ]);
        }
    }
}
