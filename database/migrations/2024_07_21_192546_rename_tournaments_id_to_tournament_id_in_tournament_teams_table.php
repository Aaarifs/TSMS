<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTournamentsIdToTournamentIdInTournamentTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournament_teams', function (Blueprint $table) {
            $table->renameColumn('tournaments_id', 'tournament_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournament_teams', function (Blueprint $table) {
            $table->renameColumn('tournament_id', 'tournaments_id');
        });
    }
}
