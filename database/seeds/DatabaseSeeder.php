<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AuctionSeeder::class,
            BidSeeder::class,
            UserinfoSeeder::class
        ]);
        for($i = 0; $i< 10; $i++){
            $this->call([
                AuctionSeeder::class,
                UserSeeder::class,
            ]);
        }
    }
}
