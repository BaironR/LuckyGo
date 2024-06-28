<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('luck_winner_numbers', function (Blueprint $table) {
            $table->date('date_raffle');
            $table->integer('luck_winner_number');
            $table->primary(['luck_winner_number', 'date_raffle']);
            $table->foreign('date_raffle')->references('date_raffle')->on('raffles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luck_winner_numbers');
    }
};
