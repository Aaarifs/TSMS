<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Player;
use App\Models\Matches;
use App\Models\Tournament;
use App\Models\Teammanager;
use Illuminate\Http\Request;
use App\Models\Tournament_team;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TournamentController extends Controller
{
   


    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    // protected function create(array $data)
    // {
    //     $user = User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);

    //     // Send the account created email
    //     Mail::to($user->email)->send(new AccountCreated($user, $data['password']));

    //     return $user;
    // }

    public function create()
    {
        return view('organiser-create');
    }

    // Store a newly created tournament in storage
    public function store(Request $request)
    {
        $data = $request->validate([
            'TournamentName' => 'required|string|max:255',
            'TournamentDate' => 'nullable|date',
            'TournamentLocation' => 'required|string|max:255',
            'TournamentType' => 'required|string|max:255',
            'TournamentFormat' => 'required|string|max:255',
        ]);
    
        $data['organiser_id'] = auth('organiser')->id(); // Ensure organiser_id is set
    
        // Log::info('Tournament Data:', $data);
        // Log::info('Test:', $data);
    
        Tournament::create([
            'name' => $request->TournamentName,
            'date' => $request->TournamentDate,
            'location' => $request->TournamentLocation,
            'type' => $request->TournamentType,
            'format' => $request->TournamentFormat,
            'organiser_id' => auth('organiser')->id()
        ]);

    
        return redirect()->route('organiser-home')->with('success', 'Tournament created successfully.');
    }
    

    // Display the specified tournament
    public function show(Tournament $tournament)
    {
        $organiserId = auth('organiser')->id(); // Get the authenticated user's ID
        $tournaments = Tournament::where('organiser_id', $organiserId)->get(); // Retrieve tournaments created by the authenticated organiser
       
        return view('organiser-home', compact('tournaments'));
    }

    // Show the form for editing the specified tournament
    public function edit($id)
    {
        $tournament = tournament::findOrFail($id);
        return view('organiser-update', compact('tournament'));
    }

    // Update the specified tournament in storage
    public function update(Request $request, $id)
    {
        $tournament = tournament::findOrFail($id);

        $data = $request->validate([
            'TournamentName' => 'required|string|max:255',
            'TournamentDate' => 'nullable|date',
            'TournamentLocation' => 'required|string|max:255',
            'TournamentType' => 'required|string|max:255',
            'TournamentFormat' => 'required|string|max:255',
        ]);

        $tournament->name = $request->TournamentName;
        $tournament->date = $request->TournamentDate;
        $tournament->location = $request->TournamentLocation;
        $tournament->type = $request->TournamentType;
        $tournament->format = $request->TournamentFormat;

        $tournament->save();


        return redirect()->route('organiser-home')->with('success', 'Tournament updated successfully.');
    }

    // Remove the specified tournament from storage
    public function destroy($id)
    {
        $tournament = tournament::findOrFail($id);
        $tournament->delete();

        return redirect()->route('organiser-home')->with('success', 'Tournament deleted successfully.');
    }

    public function registertour($tournament_id)
    {
        // Assuming the user is authenticated as a team manager
        $teammanager_id = auth('teammanager')->id();
    
        // Check if the team manager is authenticated
        if (!$teammanager_id) {
            return redirect()->route('manager-home')->with('error', 'You must be logged in as a team manager to register.');
        }
    
        // Check if there are already 8 teams registered for the tournament
        $registeredTeamsCount = Tournament_team::where('tournament_id', $tournament_id)->count();
    
        if ($registeredTeamsCount >= 8) {
            // Set a session variable to trigger the modal on the front end
            return redirect()->route('manager-home')->with('showModal', true);
        }
    
        // Create a new record in the Tournament_team table
        Tournament_team::create([
            'teammanager_id' => $teammanager_id,
            'tournament_id' => $tournament_id,
        ]);
    
        // Redirect or return a response
        return redirect()->route('manager-home')->with('success', 'Successfully registered for the tournament!');
    }
    
    
    


    

public function showOrganiserTournamentMatch($id)
{
    // Find the tournament by id
    $tournament = Tournament::findOrFail($id);

    // Find all matches associated with the tournament
    $matches = Matches::with('team1', 'team2')
                      ->where('tournament_id', $id)
                      ->get();

    // Pass the tournament and matches to the view
    return view('organiser-match', compact('tournament', 'matches'));
}




    public function showOrganiserTournamentStandings($id)
    {
        $tournament = Tournament::findOrFail($id); // Retrieve the specific tournament by its id
        return view('organiser-standings', compact('tournament')); // Pass the tournament to the view
    }

    public function showOrganiserTournamentTeams($id)
    {
        $tournament = Tournament::findOrFail($id); 
        $teammanagerIds = Tournament_team::where('tournament_id', $id)
        ->pluck('teammanager_id');
        $teams = Teammanager::whereIn('id', $teammanagerIds)->get();

        return view('organiser-team', compact('tournament','teams')); // Pass the tournament to the view
    }

    public function showManagerTournamentMatch($id)
    {
        $tournament = Tournament::findOrFail($id); // Retrieve the specific tournament by its id
        $matches = Matches::where('tournament_id', $id)->get(); // Fetch matches for the tournament
        return view('manager-match', compact('tournament', 'matches')); // Pass the tournament and matches to the view
    }

    public function showPlayerTournamentMatch($id)
    {
        $tournament = Tournament::findOrFail($id); // Retrieve the specific tournament by its id
        $matches = Matches::where('tournament_id', $id)->get(); // Fetch matches for the tournament
        return view('player-match', compact('tournament', 'matches')); // Pass the tournament and matches to the view
    }
    

    public function showManagerTournamentStandings($id)
    {
        // Fetch the tournament by its ID
        $tournament = Tournament::findOrFail($id);
    
        // Fetch standings from the tournament_teams table
        $standings = Tournament_team::where('tournament_id', $id)
            ->orderBy('standings') // Order by standings to ensure ranks are in ascending order
            ->get(['teammanager_id', 'points', 'standings']); // Fetch points and standings
    
        // Retrieve team names for displaying
        $teamIds = $standings->pluck('teammanager_id');
        $teams = Teammanager::whereIn('id', $teamIds)->get()->keyBy('id');
    
        // Map the standings to include team names and ensure ranks are assigned correctly
        $standingsWithNames = $standings->map(function ($standing) use ($teams) {
            $team = $teams->get($standing->teammanager_id);
            return [
                'team_name' => $team ? $team->team_name : 'Unknown',
                'points' => $standing->points,
                'rank' => $standing->standings, // Ensure rank is included
            ];
        });
    
        // Pass the tournament and standings to the view
        return view('manager-standings', [
            'tournament' => $tournament,
            'standings' => $standingsWithNames,
        ]);
    }

    public function showPlayerTournamentStandings($id)
    {
        // Fetch the tournament by its ID
        $tournament = Tournament::findOrFail($id);
    
        // Fetch standings from the tournament_teams table
        $standings = Tournament_team::where('tournament_id', $id)
            ->orderBy('standings') // Order by standings to ensure ranks are in ascending order
            ->get(['teammanager_id', 'points', 'standings']); // Fetch points and standings
    
        // Retrieve team names for displaying
        $teamIds = $standings->pluck('teammanager_id');
        $teams = Teammanager::whereIn('id', $teamIds)->get()->keyBy('id');
    
        // Map the standings to include team names and ensure ranks are assigned correctly
        $standingsWithNames = $standings->map(function ($standing) use ($teams) {
            $team = $teams->get($standing->teammanager_id);
            return [
                'team_name' => $team ? $team->team_name : 'Unknown',
                'points' => $standing->points,
                'rank' => $standing->standings, // Ensure rank is included
            ];
        });
    
        // Pass the tournament and standings to the view
        return view('player-standings', [
            'tournament' => $tournament,
            'standings' => $standingsWithNames,
        ]);
    }
    
    

    public function showManagerTournamentTeams($id)
    {
        $tournament = Tournament::findOrFail($id); 
        $teammanagerIds = Tournament_team::where('tournament_id', $id)
        ->pluck('teammanager_id');
        $teams = Teammanager::whereIn('id', $teammanagerIds)->get();

        return view('manager-team', compact('tournament','teams')); // Pass the tournament to the view
    }

    public function showPlayerTournamentTeams($id)
    {
        $tournament = Tournament::findOrFail($id); 
        $teammanagerIds = Tournament_team::where('tournament_id', $id)
        ->pluck('teammanager_id');
        $teams = Teammanager::whereIn('id', $teammanagerIds)->get();

        return view('player-team', compact('tournament','teams')); // Pass the tournament to the view
    }

    // public function showTournaments($type = 'upcoming') // default to 'upcoming'
    // {
    //     $today = now();
    
    //     if ($type === 'upcoming') {
    //         $tournaments = Tournament::where('date', '>', $today)->get();
    //         return view('manager-home', compact('tournaments', 'type'));
    //     } elseif ($type === 'past') {
    //         $tournaments = Tournament::where('date', '<=', $today)->get();
    //         return view('manager-past', compact('tournaments', 'type'));
    //     } else {
    //         return redirect()->back()->with('error', 'Invalid tournament type.');
    //     }
    // }
    

    public function showPlayerTournaments($type)
    {
        $today = now(); // or use Carbon::now()
    
        if ($type === 'upcoming') {
            $tournaments = Tournament::where('date', '>', $today)->get();
            return view('player-home', compact('tournaments', 'type'));
        } elseif ($type === 'past') {
            $tournaments = Tournament::where('date', '<=', $today)->get();
            return view('player-past', compact('tournaments', 'type'));
        } else {
            return redirect()->back()->with('error', 'Invalid tournament type.');
        }
    }
    
    public function showHistory()
    {
        $teammanager_id = Auth::guard('teammanager')->id();
        
        // Tournaments the team manager has registered for
        $tournamentsRegistered = Tournament::whereHas('team', function ($query) use ($teammanager_id) {
            $query->where('teammanager_id', $teammanager_id);
        })->get();
        
        return view('manager-history', compact('tournamentsRegistered'));
    }

    // private function generateMatches(Tournament $tournament)
    // {
    //     // Get all registered teams
    //     $teams = $tournament->teams()->get();
    
    //     // Shuffle teams to randomize the match generation
    //     $teams = $teams->shuffle();
    
    //     // Generate matches in a league format (each team plays 5-6 games)
    //     $matches = [];
    //     for ($i = 0; $i < $teams->count(); $i++) {
    //         for ($j = $i + 1; $j < $teams->count(); $j++) {
    //             $matches[] = [
    //                 'tournament_id' => $tournament->id,
    //                 'team1_id' => $teams[$i]->id,
    //                 'team2_id' => $teams[$j]->id,
    //                 'status' => 'Upcoming',
    //             ];
    //         }
    //     }
    
    //     return $matches;
    // }

//     public function showTournamentTree(Tournament $tournament)
// {
//     // Ensure the tournament exists
//     if (!$tournament) {
//         abort(404);
//     }

//     // Retrieve tournament data and generate the tree structure
//     $matches = $tournament->matches()->with('team1_id', 'team2_id')->get();

//     // Pass data to the view
//     return view('organiser-match-tree', [
//         'tournament' => $tournament,
//         'matches' => $matches
//     ]);
// }

// public function updateMatchStatus($matchId, Request $request)
// {
//     $match = Matches::findOrFail($matchId);
//     $match->status = $request->status;
//     $match->save();

//     return response()->json([
//         'tatus' => 'uccess',
//         'essage' => 'Match status updated successfully.'
//     ]);
// }

// public function updateMatchWinner($matchId, Request $request)
// {
//     $match = Matches::findOrFail($matchId);
//     $match->result = $request->winner;
//     $match->save();

//     return response()->json([
//         'tatus' => 'uccess',
//         'essage' => 'Match winner updated successfully.'
//     ]);
// }

public function generateMatches(Tournament $tournament)
{
    // Retrieve the teams registered for the tournament
    $teams = $tournament->teammanagers()->get();

    // Check if there are exactly 8 teams
    if ($teams->count() != 8) {
        // Return a response indicating there are not enough or too many teams
        return back()->with('error', 'There must be exactly 8 teams to generate matches.');
    }

    // Randomize the teams
    $teams = $teams->shuffle();

    // Generate all possible matches
    $matches = [];
    $totalTeams = $teams->count();

    for ($i = 0; $i < $totalTeams; $i++) {
        for ($j = $i + 1; $j < $totalTeams; $j++) {
            $matches[] = [
                'tournament_id' => $tournament->id,
                'team1_id' => $teams[$i]->id,
                'team2_id' => $teams[$j]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    }

    // Shuffle the matches to avoid back-to-back games
    shuffle($matches);

    // Insert the matches into the database
    Matches::insert($matches);

    // Return a response indicating matches have been generated
    return back()->with('success', 'Matches generated successfully.');
}






// public function generateNewRound(Tournament $tournament)
// {
//     // Get the results of the current round
//     $currentMatches = $tournament->matches()->where('status', 'Ended')->get();

//     // Ensure all matches in the current round are ended
//     if ($currentMatches->count() !== $tournament->matches()->count()) {
//         return response()->json(['status' => 'error', 'message' => 'All matches in the current round must be ended before generating a new round.'], 400);
//     }

//     // Get the winners of the current round
//     $winningTeams = $currentMatches->pluck('winner');

//     // Generate new round matches
//     $newMatches = [];
//     for ($i = 0; $i < $winningTeams->count(); $i++) {
//         for ($j = $i + 1; $j < $winningTeams->count(); $j++) {
//             $newMatches[] = [
//                 'tournament_id' => $tournament->id,
//                 'team1_id' => $winningTeams[$i],
//                 'team2_id' => $winningTeams[$j],
//                 'status' => 'Upcoming',
//             ];
//         }
//     }

//     // Save new matches to the database
//     Matches::insert($newMatches);

//     return response()->json(['status' => 'success', 'message' => 'New round generated successfully.']);
// }





    // public function generateNextRound($tournamentId)
    // {
    //     try {
    //         $tournament = Tournament::findOrFail($tournamentId);
    //         $endedMatches = $tournament->matches()->where('status', 'Ended')->get();
    
    //         // Ensure all matches in the current round have ended
    //         if ($endedMatches->count() !== 4) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'All matches in the current round must be ended before generating the next round.'
    //             ]);
    //         }
    
    //         // Get the winners of the ended matches
    //         $winningTeams = [];
    //         foreach ($endedMatches as $match) {
    //             if ($match->result == 'Team 1') {
    //                 $winningTeams[] = $match->team1;
    //             } else if ($match->result == 'Team 2') {
    //                 $winningTeams[] = $match->team2;
    //             }
    //         }
    
    //         // Clear existing matches
    //         $tournament->matches()->delete();
    
    //         // Create matches for the "Round of 4"
    //         $matches = [];
    //         for ($i = 0; $i < 4; $i += 2) {
    //             $matches[] = [
    //                 'tournament_id' => $tournament->id,
    //                 'team1_id' => $winningTeams[$i]->id,
    //                 'team2_id' => $winningTeams[$i + 1]->id,
    //                 'status' => 'Upcoming',
    //             ];
    //         }
    
    //         // Save matches
    //         foreach ($matches as $match) {
    //             Matches::create($match);
    //         }
    
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Next round matches generated successfully.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'An error occurred while generating matches: ' . $e->getMessage()
    //         ]);
    //     }
    // }
    
    public function updateMatches(Request $request, $id)
{
    $tournament = Tournament::findOrFail($id);

    foreach ($request->input('matches', []) as $matchId => $data) {
        $match = Matches::findOrFail($matchId);
        $match->status = $data['status'];
        $match->result = $data['result'];
        $match->save();
    }

    return redirect()->route('organiser-match', $id)->with('success', 'Matches updated successfully!');
}

public function generateStandings(Tournament $tournament)
{
    // Retrieve all matches for the given tournament
    $matches = Matches::where('tournament_id', $tournament->id)->get();

    // Retrieve all teams for the tournament
    $teams = Teammanager::whereIn('id', function($query) use ($tournament) {
        $query->select('teammanager_id')
              ->from('tournament_teams')
              ->where('tournament_id', $tournament->id);
    })->get()->keyBy('id');

    // Initialize points for all teams to 0
    $teamPoints = $teams->mapWithKeys(function ($team) {
        return [$team->id => ['points' => 0, 'team_name' => $team->team_name]];
    })->toArray();

    // Iterate over each match to calculate points
    foreach ($matches as $match) {
        if ($match->result) {
            if (isset($teamPoints[$match->team1_id])) {
                $teamPoints[$match->team1_id]['points'] += ($match->result == $match->team1_id) ? 3 : 0;
            }
            if (isset($teamPoints[$match->team2_id])) {
                $teamPoints[$match->team2_id]['points'] += ($match->result == $match->team2_id) ? 3 : 0;
            }
        }
    }

    // Sort the standings based on points in descending order
    uasort($teamPoints, function ($a, $b) {
        return $b['points'] - $a['points'];
    });

    // Rank the teams
    $rank = 1;
    foreach ($teamPoints as &$data) {
        $data['rank'] = $rank++;
    }
    unset($data);

    // Save standings to the tournament_teams table
    foreach ($teamPoints as $teamId => $data) {
        Tournament_team::updateOrCreate(
            ['tournament_id' => $tournament->id, 'teammanager_id' => $teamId],
            ['points' => $data['points'], 'standings' => $data['rank']]
        );
    }

    // Pass the standings to the view
    return view('organiser-standings', [
        'tournament' => $tournament,
        'standings' => $teamPoints,
    ]);
}



    

// TournamentController.php

public function showStandings(Tournament $tournament)
{
    // Fetch standings from the tournament_teams table
    $standings = Tournament_team::where('tournament_id', $tournament->id)
                                ->orderBy('standings') // Order by standings to ensure ranks are in ascending order
                                ->get(['teammanager_id', 'points', 'standings']); // Fetch points and standings

    // Retrieve team names for displaying
    $teamIds = $standings->pluck('teammanager_id');
    $teams = Teammanager::whereIn('id', $teamIds)->get()->keyBy('id');

    // Map the standings to include team names and ensure ranks are assigned correctly
    $standingsWithNames = $standings->map(function ($standing) use ($teams) {
        $team = $teams->get($standing->teammanager_id);
        return [
            'team_name' => $team ? $team->team_name : 'Unknown',
            'points' => $standing->points,
            'rank' => $standing->standings, // Ensure rank is included
        ];
    });

    // Pass the standings to the view
    return view('organiser-standings', [
        'tournament' => $tournament,
        'standings' => $standingsWithNames,
    ]);
}




    // public function updateMatches(Request $request, $id)
    // {
    //     $tournament = Tournament::findOrFail($id);
    
    //     foreach ($request->input('matches', []) as $matchId => $data) {
    //         $match = Matches::findOrFail($matchId);
    //         $match->status = $data['status'];
    //         $match->result = $data['result'];
    //         $match->save();
    //     }
    
    //     return redirect()->route('organiser-match', $id)->with('success', 'Matches updated successfully!');
    // }
    // public function updateMatchWinner($matchId, Request $request)
    // {
    //     $match = Matches::findOrFail($matchId);
    //     $match->result = $request->winner;
    //     $match->save();
    
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Match winner updated successfully.'
    //     ]);
    // }

    public function withdraw($id)
    {
        $teamManager = Auth::guard('teammanager')->user();

        if (!$teamManager) {
            return redirect()->back()->with('error', 'You need to be logged in to withdraw from a tournament.');
        }

        try {
            // Find the tournament
            $tournament = Tournament::findOrFail($id);

            // Detach the team manager from the tournament
            $teamManager->tournaments()->detach($id);

            return redirect()->back()->with('success', 'You have successfully withdrawn from the tournament.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while withdrawing from the tournament: ' . $e->getMessage());
        }
    }

    public function showRequestForm()
    {
        // Fetch all teams
        $teams = Teammanager::all();
        // Fetch the current user's pending request if any
        $user = auth()->user();
        // $pendingRequest = Player::where('player_id', $user->id)->where('status', 'Pending')->first();
        
        return view('player-request', compact('teams'));
    }
    
    
    public function submitRequest(Request $request)
{
    // Get the authenticated player
    $user = Auth::guard('player')->user();

    // Validate the request data
    $request->validate([
        'team_name' => 'required|exists:teammanagers,id', // Ensure the team name exists in the database
    ]);

    // Check if the user already has a pending request
    if (Player::where('id', $user->id)->where('status', 'Pending')->exists()) {
        return redirect()->route('pending-request')->with('error', 'You already have a pending request.');
    }

    // Update the player's teammanager_id and status
    $user->teammanager_id = $request->team_name;
    $user->status = 'Pending';
    $user->save();

    return redirect()->route('pending-request')->with('success', 'Your request has been submitted.');
}


    public function teamview()
    {
        // Get the authenticated player
        $user = Auth::guard('player')->user();
    
        // Check if the user already has a pending request
        if (Player::where('id', $user->id)->where('status', 'Pending')->exists()) {
            return redirect()->route('pending-request');
        }
        // Check if the user already has an accepted request
        elseif (Player::where('id', $user->id)->where('status', 'Accepted')->exists()) {
            return redirect()->route('team-player');
        }
        // Redirect to the player request page if no pending or accepted request exists
        else {
            return redirect()->route('player-request');
        }
    }
    

    public function teamplayer()
    {
        // Get the authenticated player
        $player = Auth::guard('player')->user();
        
        // Assuming `teammanager_id` is a field on the Player model
        $teammanager_id = $player->teammanager_id;
    
        // Fetch the team manager's details
        $teammanager = Teammanager::find($teammanager_id);
    
        // Fetch tournaments where the player's team is registered
        $tournamentsRegistered = Tournament::whereHas('team', function ($query) use ($teammanager_id) {
            $query->where('teammanager_id', $teammanager_id);
        })->get();
        
        // Pass the tournaments and team manager to the view
        return view('player-team-approved', compact('tournamentsRegistered', 'teammanager'));
    }
    
    

    public function pendingrequest()
    {
    
        $requests = Player::where('id', Auth::guard('player')->id())
        ->with('teammanager') // Eager load the relationship
        ->get();
        
        return view('player-pending', compact('requests'));

    }
    

    public function showPendingRequests()
    {
        $user = auth()->user();
        $requests = Player::where('player_id', $user->id)
                            ->with('teammanager') // Eager load the relationship
                            ->get();
    
        return view('player-requests', compact('requests'));
    }

    // public function showManagerPlayer()
    // {
    //      return view('manager-player');

    // }

    public function showNewPlayerRequests()
    {
        $teamManager = Auth::guard('teammanager')->user();
        $requests = Player::where('teammanager_id', $teamManager->id)
                          ->where('status', 'Pending')
                          ->get();
    
        return view('manager-player-new', compact('requests'));
    }
    
    public function approveRequest($id)
    {
        $request = Player::find($id);
        $request->status = 'Accepted';
        $request->save();
    
        return redirect()->route('manager-player-new')->with('success', 'Player request approved.');
    }
    
    public function declineRequest($id)
    {
        $request = Player::find($id);
        $request->status = 'Declined';
        $request->save();
    
        return redirect()->route('manager-player-new')->with('success', 'Player request declined.');
    }
    
    public function showApprovedPlayers()
    {
        // Get the current team manager
        $teamManager = Auth::guard('teammanager')->user();
    
        // Fetch approved players for the current team manager
        $approvedPlayers = Player::where('teammanager_id', $teamManager->id)
                                  ->where('status', 'Accepted')
                                  ->get();
    
        // Pass the approvedPlayers variable to the view
        return view('manager-player', compact('approvedPlayers'));
    }
    
    
    
    
    

    
 
    

}
