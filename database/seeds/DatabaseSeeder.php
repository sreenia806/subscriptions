<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        DB::table('users')->insert([
            'name' => 'Sreenivasulu Avula',
            'email' => 'sreeniavasulu@gmail.com',
            'password' => Hash::make('password')
        ]);


        DB::table('plans')->insert([
            'code' => 'gb',
            'name' => 'UK',
            'monthly_cost' => 10,
            'yearly_cost' => 50,
        ]);
        DB::table('plans')->insert([
            'code' => 'fr',
            'name' => 'France',
            'monthly_cost' => 10,
            'yearly_cost' => 60,
        ]);
        DB::table('plans')->insert([
            'code' => 'de',
            'name' => 'Germany',
            'monthly_cost' => 15,
            'yearly_cost' => 75,
        ]);
        DB::table('plans')->insert([
            'code' => 'us',
            'name' => 'USA',
            'monthly_cost' => 25,
            'yearly_cost' => 150,
        ]);
        DB::table('plans')->insert([
            'code' => 'jp',
            'name' => 'Japan',
            'monthly_cost' => 15,
            'yearly_cost' => 65,
        ]);
    }
}
