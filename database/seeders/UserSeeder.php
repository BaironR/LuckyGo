<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            'name'=> 'Antonio Barraza Guzmán',
            'email' => 'antonio.barraza.guzman@gmail.com',
            'password' => Hash::make('Luckygo23'),
            'age' => 0,
            'lotteries_entered' => 0,
            'status' => true,
            'is_admin' => true,
            'is_sorter' => false
        ]);
    }
}
