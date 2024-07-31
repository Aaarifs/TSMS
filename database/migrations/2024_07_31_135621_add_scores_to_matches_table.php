<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoresToMatchesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->integer('team1_score')->nullable()->after('result');
            $table->integer('team2_score')->nullable()->after('team1_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('team1_score');
            $table->dropColumn('team2_score');
        });
    }
}

