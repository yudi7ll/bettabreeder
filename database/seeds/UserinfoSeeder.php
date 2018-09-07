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
            [
                'users_id' => 1,
                'cover' => '1.png',
                'seller_code' => 'SL134515241',
                'gender' => 'Man',
                'address' => str_random(10),
                'city' => 'Denpasar',
                'zip' => 80117,
                'country' => 'Indonesia',
                'telp' => 12468,
                'lastActivity' => Carbon\Carbon::now(),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ],[
                'users_id' => 2,
                'cover' => '2.png',
                'seller_code' => 'SL113214132',
                'gender' => 'Man',
                'address' => str_random(10),
                'city' => 'Denpasar',
                'zip' => 80117,
                'country' => 'Indonesia',
                'telp' => 62541344,
                'lastActivity' => Carbon\Carbon::now(),
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now()
            ]
        ]);
    }
}
