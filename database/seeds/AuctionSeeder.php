<?php

use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('auctions')->insert([
            [
                'name' => $faker->name,
                'type' => $faker->lastName,
                'size' => $faker->randomDigit,
                'users_id' => $faker->numberBetween($min=1, $max=10),
                'age' => $faker->numberBetween($min=0, $max=40),
                'opening_price' => $faker->numberBetween($min=10000, $max=300000),
                'product_code' => 'BT1',
                'start_date' => \Carbon\Carbon::now(),
                'deadline' => \Carbon\Carbon::now()->addDays(2),
                'seen' => 1,
                'status' => 'Open',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],[
                'name' => $faker->name,
                'type' => $faker->lastName,
                'size' => $faker->randomDigit,
                'users_id' => $faker->numberBetween($min=1, $max=10),
                'age' => $faker->numberBetween($min=0, $max=40),
                'opening_price' => $faker->numberBetween($min=10000, $max=300000),
                'product_code' => 'BT1',
                'start_date' => \Carbon\Carbon::now(),
                'deadline' => \Carbon\Carbon::now()->addDays(2),
                'seen' => 1,
                'status' => 'Open',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ]);
    }
}
