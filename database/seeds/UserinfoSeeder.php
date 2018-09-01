<?php

use Illuminate\Database\Seeder;

class UserinfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userinfos')->insert([
            'users_id' => 1,
            'cover' => 'no-image.jpg',
            'seller_code' => 'SL1',
            'gender' => 'Man',
            'address' => str_random(10),
            'city' => 'Denpasar',
            'zip' => 80117,
            'country' => 'Indonesia',
            'telp' => 12468,
            'birth' => Carbon\Carbon::now(),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);
    }
}
