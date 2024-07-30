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
<body style="background-image: url('{{ asset('image/backgroundtsms.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
<nav class="navbar navbar-expand-lg navbar-light sticky-top" style="width: 100%; background-color:#0866FF;">
<a href="{{ route('player-home') }}" class="btn btn-link position-absolute text-white" style=" text-decoration: none;">&lt; Back</a>
<div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="dropdown mx-auto">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('image/logo (4).png') }}" alt="Logo" style="width:64px;height:36px;">
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{ route('player-profile') }}">Profile</a></li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
            </ul>
        </div>
    </div>
</nav>
<main style="display: flex; flex-direction: column; min-height: 15vh;">
    <div class="col-md-8 mx-auto">
        <div class="container-expand-lg px-0" style="display: flex; justify-content: center;">
            <a href="{{ route('player-match', $tournament->id) }}" class="btn btn-primary" style="margin-right: 10px; margin-top: 10px;">Match</a>
            <a href="{{ route('player-standings', $tournament->id) }}" class="btn btn-primary disabled" style="margin-right: 10px; margin-top: 10px;">Standings</a>
            <a href="{{ route('player-team', $tournament->id) }}" class="btn btn-primary" style="margin-top: 10px;">Teams</a>
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
                                <h3 class="text-white text-center">Standings</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3 text-center">
                                <h6>{{ $tournament->name }}</h6>
                                <hr style="width:50%; margin-left:auto; margin-right:auto;">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Rank</th>
                                            <th>Team</th>
                                            <th>Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($standings as $team)
                                            <tr>
                                                <td>{{ $team['rank'] }}</td>
                                                <td>{{ $team['team_name'] }}</td>
                                                <td>{{ $team['points'] }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No standings available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
