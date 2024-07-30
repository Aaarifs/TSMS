<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id');
            $table->foreign('tournament_id')->references('id')->on('tournaments');
            $table->unsignedBigInteger('team1_id')->nullable();
            $table->foreign('team1_id')->references('id')->on('teammanagers'); 
            $table->unsignedBigInteger('team2_id')->nullable();
            $table->foreign('team2_id')->references('id')->on('teammanagers'); 
            $table->string('status')->nullable(); // Can be "upcoming", "ongoing", "ended"
            $table->string('result')->nullable(); // Can be "win", "loss", "draw"
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
