<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TSMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../image/backgroundtsms.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">

  <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="width: 100%; background-color:#0866FF;">
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
        </ul>
      </div>
    </div>
  </nav>

  <main style="display: flex; flex-direction: column; min-height: 15vh;">
    <div class="container-expand-lg px-0" style="display: flex; justify-content: center;">
        <a href="{{ route('organiser-create') }}" type="button" class="btn btn-success" style="margin-right: 10px; margin-top: 10px;">Create Tournament</a>
    </div>
    <div class="d-flex justify-content-center">
        <hr style="width: 50%;">
    </div>
    <div class="container mt-3">
        <div class="row justify-content-center">
            @if($tournaments->isEmpty())
                <p class="text-center">No tournaments available.</p>
            @else
                @foreach($tournaments as $tournament)
                    <div class="col-md-4 d-flex justify-content-center mb-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $tournament->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $tournament->date }}</h6>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $tournament->location }}</h6>
                                <p class="card-text">{{ $tournament->type }}, {{ $tournament->format }}</p>
                                <!-- Dropdown for more options -->
                                <div class="dropdown d-flex justify-content-end mt-3">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{ route('organiser-update', $tournament->id) }}">Edit</a></li>
                                        <li><a class="dropdown-item" href="{{ route('organiser-match', $tournament->id) }}">View</a></li>
                                        <li>
                                            <form action="{{ route('tournaments.destroy', $tournament->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
