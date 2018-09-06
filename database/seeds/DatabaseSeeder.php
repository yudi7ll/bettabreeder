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
            UserinfoSeeder::class,
            UserSeeder::class,
            AuctionSeeder::class,
        ]);
    }
}
