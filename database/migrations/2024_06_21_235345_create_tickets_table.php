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
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->date('date');
            $table->integer('number_1');
            $table->integer('number_2');
            $table->integer('number_3');
            $table->integer('number_4');
            $table->integer('number_5');
            $table->boolean('luck');
            $table->boolean('is_winner');
            $table->boolean('is_luck_winner');
            $table->date('date_raffle');
            $table->foreign('date_raffle')->references('date_raffle')->on('raffles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
