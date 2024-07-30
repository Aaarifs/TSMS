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
<a href="{{ route('organiser-home') }}" class="btn btn-link position-absolute text-white" style=" text-decoration: none;">&lt; Back</a>
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
            <a href="{{ route('organiser-match', $tournament->id) }}" class="btn btn-primary disabled" style="margin-right: 10px; margin-top: 10px;">Match</a>
            <a href="{{ route('organiser-standings', $tournament->id) }}" class="btn btn-primary" style="margin-right: 10px; margin-top: 10px;">Standings</a>
            <a href="{{ route('organiser-team', $tournament->id) }}" class="btn btn-primary" style="margin-top: 10px;">Teams</a>
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
                                <a href="{{ route('generate.matches', $tournament->id) }}">

                                <button id="generate-matches-btn" class="btn btn-light position-absolute end-0">
                                        Generate Matches
                                    </button>
                                </a>                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3 text-center">
                                <h6>{{ $tournament->name }}</h6>
                                <hr style="width:50%; margin-left:auto; margin-right:auto;">
                            </div>
                            <form id="matches-form" method="POST" action="{{ route('update.matches', $tournament->id) }}">
                                @csrf
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
                                                @php $no = 0; @endphp
                                                @foreach($matches as $match)
                                                    <tr>
                                                        <td>{{ ++$no }}</td>
                                                        <td>
                                                            <select class="form-select status-select" name="matches[{{ $match->id }}][status]">
                                                                <option value="Upcoming" {{ $match->status == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
                                                                <option value="Ongoing" {{ $match->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                                                                <option value="Ended" {{ $match->status == 'Ended' ? 'selected' : '' }}>Ended</option>
                                                            </select>
                                                        </td>
                                                        <td>{{ $match->team1 ? $match->team1->team_name : 'N/A' }}</td>
                                                        <td>{{ $match->team2 ? $match->team2->team_name : 'N/A' }}</td>
                                                        <td>
                                                            <select class="form-select winner-select" name="matches[{{ $match->id }}][result]">
                                                            <option value="">Select Winner</option>
@if($match->team1)
    <option value="{{ $match->team1->id }}" {{ $match->result == $match->team1->id ? 'selected' : '' }}>
        {{ $match->team1->team_name }}
    </option>
@else
    <option value="N/A">N/A</option>
@endif

@if($match->team2)
    <option value="{{ $match->team2->id }}" {{ $match->result == $match->team2->id ? 'selected' : '' }}>
        {{ $match->team2->team_name }}
    </option>
@else
    <option value="N/A">N/A</option>
@endif

                                                            </select> 
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
                                    <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary align-items-center">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageModalLabel">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalMessageBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
