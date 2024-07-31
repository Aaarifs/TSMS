<?php

use App\Models\Tournament;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;

Route::get('/', function () {
    return view('login');
});

// Authentication Routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register-store', [AuthController::class, 'register'])->name('register-store');
Route::post('/login-s', [AuthController::class, 'login'])->name('login-store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes

    // Route::get('/manager-home', [AuthController::class, 'showManager'])->name('manager-home');
    Route::post('/organiser-home', [AuthController::class, 'login']);
    Route::post('/manager-home', [AuthController::class, 'login']);
    Route::post('/player-home', [AuthController::class, 'login']);

    // Organiser
    Route::get('/organiser-home', [AuthController::class, 'showOrganiser'])->name('organiser-home');
    Route::get('/organiser-create', [TournamentController::class, 'create'])->name('organiser-create');
    Route::post('/organiser-create', [TournamentController::class, 'store'])->name('tournaments.store');
    Route::get('/tournament-edit/{id}', [TournamentController::class, 'edit'])->name('organiser-update');
    Route::post('/tournament-edit/{id}', [TournamentController::class, 'update'])->name('tournaments.update');
    Route::delete('/tournaments/{id}', [TournamentController::class, 'destroy'])->name('tournaments.destroy');
    Route::get('/organiser-tournament-team/{id}', [TournamentController::class, 'showOrganiserTournamentMatch'])->name('organiser-match');
    // web.php
Route::post('/tournaments/{id}/update-matches', [TournamentController::class, 'updateMatches'])->name('update.matches');

// web.php
Route::post('/tournaments/{tournament}/standings/generate', [TournamentController::class, 'generateStandings'])->name('generate.standings');

// routes/web.php

Route::get('/tournaments/{tournament}/generate-matches', [TournamentController::class, 'generateMatches'])->name('generate.matches');

    Route::post('/tournaments/{tournament}/generate-new-round', [TournamentController::class, 'generateNewRound']);
    Route::post('/matches/{matchId}/update-status', [TournamentController::class, 'updateMatchStatus']);
Route::post('/matches/{matchId}/update-winner', [TournamentController::class, 'updateMatchWinner']);
Route::get('/tournament/{tournament}/standings', [TournamentController::class, 'showStandings'])->name('organiser-standings');
    Route::get('/organiser-tournament-teams/{id}', [TournamentController::class, 'showOrganiserTournamentTeams'])->name('organiser-team');

    Route::get('/organiser-profile', [AuthController::class, 'showOrganiserProfile'])->name('organiser-profile');
    Route::get('/organiser-profile/update', [AuthController::class, 'showOrganiserUpdateAccountForm'])->name('organiser-updateprof');
    Route::post('/organiser-profile/update', [AuthController::class, 'OrganiserUpdateAccount'])->name('organiser-updateprof');

    Route::get('/organiser/team/{team}', [TeamController::class, 'showTeamPlayers'])->name('organiser-team-players');


    // Route to view tournament matches and tree
// Route::get('/tournaments/{tournament}/matches/tree', [TournamentController::class, 'showTournamentTree'])->name('organiser-match-tree');

    


    // Teammanager
    Route::get('/manager-tournament-match/{id}', [TournamentController::class, 'showManagerTournamentMatch'])
    ->name('manager-match')->middleware('auth:teammanager');

Route::get('/manager-tournament-standings/{id}', [TournamentController::class, 'showManagerTournamentStandings'])
    ->name('manager-standings')
    ->middleware('auth:teammanager');

Route::get('/manager-tournament-teams/{id}', [TournamentController::class, 'showManagerTournamentTeams'])
    ->name('manager-team')
    ->middleware('auth:teammanager');

Route::post('/registertour/{tournament}', [TournamentController::class, 'registertour'])
    ->name('registertour')
    ->middleware('auth:teammanager');

Route::get('/manager-home', [AuthController::class, 'showManager'])
    ->name('manager-home')
    ->middleware('auth:teammanager');

    Route::get('/manager/history', [TournamentController::class, 'showHistory'])->name('manager-history');
    Route::delete('/tournaments/{id}/withdraw', [TournamentController::class, 'withdraw'])->name('withdraw-tournament')->middleware('auth:teammanager');

    Route::get('/manager-profile', [AuthController::class, 'showManagerProfile'])->name('manager-profile');
    Route::get('/manager-profile/update', [AuthController::class, 'showManagerUpdateAccountForm'])->name('manager-updateprof');
    Route::post('/manager-profile/update', [AuthController::class, 'ManagerUpdateAccount'])->name('manager-updateprof');


    Route::get('/manager-players', [TournamentController::class, 'showApprovedPlayers'])->name('manager-player');

    Route::get('/manager-player-new', [TournamentController::class, 'showNewPlayerRequests'])->name('manager-player-new');
    Route::post('/approve-request/{id}', [TournamentController::class, 'approveRequest'])->name('approve-request');
    Route::post('/decline-request/{id}', [TournamentController::class, 'declineRequest'])->name('decline-request');
    



    // Player
    Route::get('/player-home', [AuthController::class, 'showPlayer'])->name('player-home');
    Route::get('player/tournaments/past', [TournamentController::class, 'showPastTournaments'])->name('player-past');
    Route::get('/tournament-match/{id}', [TournamentController::class, 'showPlayerTournamentMatch'])->name('player-match')->middleware('auth:player');
    Route::get('/tournament-standings/{id}', [TournamentController::class, 'showPlayerTournamentStandings'])->name('player-standings')->middleware('auth:player');
    Route::get('/tournament-teams/{id}', [TournamentController::class, 'showPlayerTournamentTeams'])->name('player-team')->middleware('auth:player');

    
    Route::get('/player-profile', [AuthController::class, 'showPlayerProfile'])->name('player-profile');
    Route::get('/player-profile/update', [AuthController::class, 'showPlayerUpdateAccountForm'])->name('player-updateprof');
    Route::post('/player-profile/update', [AuthController::class, 'PlayerUpdateAccount'])->name('player-updateprof');

// Route to show the form for requesting to join a team
Route::get('/player-request', [TournamentController::class, 'showRequestForm'])->name('player-request');

Route::post('/player-request/submit', [TournamentController::class, 'submitRequest'])->name('player-request-submit');

// Route to show the player's pending requests
Route::get('/player-requests', [TournamentController::class, 'showPendingRequests'])->name('player-requests');

Route::get('/team-view', [TournamentController::class, 'teamview'])->name('team-view');

Route::get('/team-player', [TournamentController::class, 'teamplayer'])->name('team-player');

Route::get('/pending-request', [TournamentController::class, 'pendingrequest'])->name('pending-request');

    

    
    

  
