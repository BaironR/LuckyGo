<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RaffleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('raffles')->insert([

            'date_raffle'=> '2024-06-16',
            'number_of_tickets' => 2,
            'total' => 5000,
            'total_luck' => 1000,
            'subtotal_of_tickets' => 4000,
            'status_raffle' => 0,
            'luck_raffle' => true,
            'entered_date' => null,
            'user_id' => null
        ]);
        DB::table('raffles')->insert([

            'date_raffle'=> '2024-06-23',
            'number_of_tickets' => 1,
            'total' => 2000,
            'total_luck' => 0,
            'subtotal_of_tickets' => 2000,
            'status_raffle' => 0,
            'luck_raffle' => false,
            'entered_date' => null,
            'user_id' => null
        ]);


    }
}
