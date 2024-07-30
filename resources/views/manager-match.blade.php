<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TSMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../image/backgroundtsms.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="width: 100%; background-color:#0866FF;">
<a href="{{ route('manager-home') }}" class="btn btn-link position-absolute text-white" style=" text-decoration: none;">&lt; Back</a>
<div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="dropdown mx-auto">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../image/logo (4).png" alt="Logo" style="width:64px;height:36px;">
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{ route('organiser-profile') }}">Profile</a></li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </div>
    </div>
</nav>
<main style="display: flex; flex-direction: column; min-height: 15vh;">
    <div class="col-md-8 mx-auto">
        <div class="container-expand-lg px-0" style="display: flex; justify-content: center;">
            <a href="{{ route('manager-match', $tournament->id) }}" class="btn btn-primary disabled" style="margin-right: 10px; margin-top: 10px;">Match</a>
            <a href="{{ route('manager-standings', $tournament->id) }}" class="btn btn-primary" style="margin-right: 10px; margin-top: 10px;">Standings</a>
            <a href="{{ route('manager-team', $tournament->id) }}" class="btn btn-primary" style="margin-top: 10px;">Teams</a>
        </div>
        <div class="d-flex justify-content-center">
            <hr style="width: 50%;">
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" style="width: 100%; background-color:#0866FF;">
                            <div class="d-flex flex-grow-1 justify-content-center position-relative">
                                <h3 class="text-white text-center">Match</h3>
                      </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3 text-center">
                                <h6>{{ $tournament->name }}</h6>
                                <hr style="width:50%; margin-left:auto; margin-right:auto;">
                            </div>
                                <div class="table-responsive">
                                    <table class="table text-center">
                                        <thead>
                                            <tr>
                                                <th>Match</th>
                                                <th >Status</th>
                                                <th >Team 1</th>
                                                <th >Team 2</th>
                                                <th >Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            @if($matches->isNotEmpty())
                                @foreach($matches as $match)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($match->status == 'Upcoming')
                                                <span class="badge bg-secondary">Upcoming</span>
                                            @elseif($match->status == 'Ongoing')
                                                <span class="badge bg-success">Ongoing</span>
                                            @elseif($match->status == 'Ended')
                                                <span class="badge bg-danger">Ended</span>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $match->team1 ? $match->team1->team_name : 'N/A' }}</td>
                                        <td>{{ $match->team2 ? $match->team2->team_name : 'N/A' }}</td>
                                        <td>
                                            @if($match->result)
                                                {{ $match->result == $match->team1->id ? $match->team1->team_name : ($match->result == $match->team2->id ? $match->team2->team_name : 'N/A') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No matches available.</td>
                                </tr>
                            @endif
                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
