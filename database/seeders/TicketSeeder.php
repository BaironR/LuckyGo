<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tickets')->insert([
            'id'=> 'LG123',
            'date' => '2024-06-15 16:15',
            'number_1' => 1,
            'number_2' => 2,
            'number_3' => 3,
            'number_4' => 4,
            'number_5' => 5,
            'luck' => false,
            'is_winner' => false,
            'is_luck_winner' => false,
            'date_raffle' => '2024-06-16'
        ]);

        DB::table('tickets')->insert([

            'id'=> 'LG126',
            'date' => '2024-06-15 18:59',
            'number_1' => 1,
            'number_2' => 2,
            'number_3' => 3,
            'number_4' => 4,
            'number_5' => 5,
            'luck' => true,
            'is_winner' => false,
            'is_luck_winner' => false,
            'date_raffle' => '2024-06-16'
        ]);

        DB::table('tickets')->insert([

            'id'=> 'LG169',
            'date' => '2024-06-20 19:20',
            'number_1' => 1,
            'number_2' => 2,
            'number_3' => 3,
            'number_4' => 4,
            'number_5' => 5,
            'luck' => false,
            'is_winner' => false,
            'is_luck_winner' => false,
            'date_raffle' => '2024-06-23'
        ]);
    }
}
