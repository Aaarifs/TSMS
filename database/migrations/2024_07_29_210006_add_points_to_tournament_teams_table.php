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
        Schema::table('tournament_teams', function (Blueprint $table) {
            $table->integer('points')->nullable()->after('standings'); // Adjust 'existing_column' as necessary
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournament_teams', function (Blueprint $table) {
            //
        });
    }
};
