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
        Schema::create('raffles', function (Blueprint $table) {
            $table->date('date_raffle')->primary();
            $table->integer('number_of_tickets');
            $table->integer('total');
            $table->integer('total_luck');
            $table->integer('subtotal_of_tickets');
            $table->integer('status_raffle');
            $table->boolean('luck_raffle');
            $table->string('entered_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
