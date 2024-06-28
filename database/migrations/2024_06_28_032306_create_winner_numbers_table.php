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
        Schema::create('winner_numbers', function (Blueprint $table) {
            $table->date('date_raffle');
            $table->integer('winner_number');
            $table->primary(['winner_number', 'date_raffle']);
            $table->foreign('date_raffle')->references('date_raffle')->on('raffles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winner_numbers');
    }
};
