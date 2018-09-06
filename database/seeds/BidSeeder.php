<?php

use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bids')->insert([
            [
                'users_id' => 1,
                'auctions_id' => 1,
                'price' => 240000,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ],[
                'users_id' => 2,
                'auctions_id' => 1,
                'price' => 565000,
                'created_at' => Carbon\Carbon::now()->addMinutes(1),
                'updated_at' => Carbon\Carbon::now()
            ]
        ]);
    }
}
