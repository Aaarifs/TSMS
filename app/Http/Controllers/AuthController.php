<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Player;
use App\Models\Organiser;
use App\Models\Tournament;
use App\Models\Teammanager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request) {
        // Validate the incoming request data
        $request->validate([
            'fullname' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('players'),
            ],
            'phone_number' => [
                'required',
                'max:255',
                Rule::unique('players'),
            ],
            'password' => 'required|confirmed',
            'account_type' => 'required|in:player,teammanager,organiser',
            'team_name' => 'required_if:account_type,teammanager|max:255',
        ]);

        // Create a new record based on account type
        if ($request->account_type === 'player') {
            $player = Player::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);
        } elseif ($request->account_type === 'organiser') {
            // Assuming you have an Organiser model
            $organiser = Organiser::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);
        } else  {
            // Assuming you have a Team Manager model
            $teammanager = Teammanager::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'team_name' => $request->team_name,
            ]);
        }

        // Redirect to the login page
        return redirect('/login')->with('success', 'Account created successfully. Please login.');
    }

    // Login a user and create a token

    public function showOrganiser()
    {
        $organiserId = auth('organiser')->id(); // Get the authenticated user's ID
        $tournaments = Tournament::where('organiser_id', $organiserId)->get(); // Retrieve tournaments created by the authenticated organiser
        return view('organiser-home', compact('tournaments'));
    }

   // Import Carbon for date and time operations

// AuthController:
public function showManager(Request $request)
{
    $teammanager_id = Auth::guard('teammanager')->id();
    $timezone = 'Asia/Kuala_Lumpur';
    $now = Carbon::now($timezone);
    $type = $request->query('type', 'upcoming');

    $tournaments = Tournament::when($type == 'past', function ($query) use ($now) {
        $query->where('date', '<=', $now);
    }, function ($query) use ($now) {
        $query->where('date', '>', $now);
    })
    ->whereDoesntHave('team', function ($query) use ($teammanager_id) {
        $query->where('teammanager_id', $teammanager_id);
    })
    ->get();

    return view('manager-home', [
        'tournaments' => $tournaments,
        'type' => $type
    ]);
}


    
        

public function showPlayer(Request $request)
{
    // Set the default time zone to Asia/Kuala_Lumpur
    $timezone = 'Asia/Kuala_Lumpur';
    $now = Carbon::now($timezone);
    
    // Determine the type of tournaments to show (upcoming or past)
    $type = $request->query('type', 'upcoming');

    // Fetch the tournaments based on the type
    $tournaments = Tournament::when($type == 'past', function ($query) use ($now) {
        $query->where('date', '<=', $now);
    }, function ($query) use ($now) {
        $query->where('date', '>', $now);
    })
    ->get();

    return view('player-home', [
        'tournaments' => $tournaments,
        'type' => $type
    ]);
}

        

    
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to login as player
        if (Auth::guard('player')->attempt($request->only('email', 'password'))) {
            return redirect()->route('player-home');
        }
        
        // Attempt to login as team manager
        elseif (Auth::guard('teammanager')->attempt($request->only('email', 'password'))) {
            return redirect()->route('manager-home');
        }
        
        // Attempt to login as organiser
        elseif (Auth::guard('organiser')->attempt($request->only('email', 'password'))) {
            return redirect()->route('organiser-home');

        }

        // If authentication fails
        return back()->with('error', 'Invalid username or password');
    }

    // Logout the authenticated user
    public function logout(Request $request)
    {
        if (Auth::guard('player')->check()) {
            Auth::guard('player')->logout();
        } elseif (Auth::guard('teammanager')->check()) {
            Auth::guard('teammanager')->logout();
        } elseif (Auth::guard('organiser')->check()) {
            Auth::guard('organiser')->logout();
        }
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login')->with('success', 'Logged out successfully.');
    }


// AuthController.php

public function showOrganiserProfile()
{
    $organiser = auth()->guard('organiser')->user(); // Get the authenticated organiser
    return view('organiser-profile', compact('organiser'));
}

public function showOrganiserUpdateAccountForm()
{
    $organiser = auth()->guard('organiser')->user(); // Get the authenticated organiser
    return view('organiser-updateprof', compact('organiser'));
}

public function OrganiserUpdateAccount(Request $request)
{
    $organiser = auth()->guard('organiser')->user();

    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:organisers,email,' . $organiser->id,
        'phone_number' => 'required|string|max:15',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $organiser->fullname = $request->fullname;
    $organiser->email = $request->email;
    $organiser->phone_number = $request->phone_number;

    if ($request->filled('password')) {
        $organiser->password = bcrypt($request->password);
    }

    $organiser->save();

    return redirect()->route('organiser-profile')->with('success', 'Account updated successfully.');
}

public function showManagerProfile()
{
    $teammanager = auth()->guard('teammanager')->user(); // Get the authenticated organiser
    return view('manager-profile', compact('teammanager'));
}

public function showManagerUpdateAccountForm()
{
    $teammanager = auth()->guard('teammanager')->user(); // Get the authenticated organiser
    return view('manager-updateprof', compact('teammanager'));
}

public function ManagerUpdateAccount(Request $request)
{
    $teammanager = auth()->guard('teammanager')->user();

    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:teammanagers,email,' . $teammanager->id,
        'phone_number' => 'required|string|max:15',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $teammanager->fullname = $request->fullname;
    $teammanager->email = $request->email;
    $teammanager->phone_number = $request->phone_number;
    $teammanager->team_name = $request->team_name;
    

    if ($request->filled('password')) {
        $teammanager->password = bcrypt($request->password);
    }

    $teammanager->save();

    return redirect()->route('manager-profile')->with('success', 'Account updated successfully.');
}

public function showPlayerProfile()
{
    $player = auth()->guard('player')->user(); // Get the authenticated organiser
    return view('player-profile', compact('player'));
}

public function showPlayerUpdateAccountForm()
{
    $player = auth()->guard('player')->user(); // Get the authenticated organiser
    return view('player-updateprof', compact('player'));
}

public function PlayerUpdateAccount(Request $request)
{
    $player = auth()->guard('player')->user();

    $request->validate([
        'fullname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:teammanagers,email,' . $player->id,
        'phone_number' => 'required|string|max:15',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $player->fullname = $request->fullname;
    $player->email = $request->email;
    $player->phone_number = $request->phone_number;
    

    if ($request->filled('password')) {
        $player->password = bcrypt($request->password);
    }

    $player->save();

    return redirect()->route('player-profile')->with('success', 'Account updated successfully.');
}


}
