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
            $table->integer('standings')->nullable()->after('tournament_id'); // Replace 'existing_column' with the column after which you want to add the new column
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
