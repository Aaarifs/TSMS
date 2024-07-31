<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TSMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
          <li><a class="dropdown-item" href="{{ route('manager-profile') }}">Profile</a></li>
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
        <a href="{{ route('manager-player') }}" type="button" class="btn btn-primary" style="margin-top: 10px; margin-right: 10px;">Players</a>
        <a href="{{ route('manager-home', ['type' => 'upcoming']) }}" type="button" class="btn btn-primary {{ ($type == 'upcoming' || $type == 'past') ? 'disabled' : '' }}
" style="margin-top: 10px; margin-right: 10px;">Tournament</a>
        <a href="{{ route('manager-history') }}" type="button" class="btn btn-primary" style="margin-top: 10px;">History</a>
    </div>
    <div class="d-flex justify-content-center">
        <hr style="width: 50%;">
    </div>
    <div class="container">
        <div class="container-expand-lg px-0" style="display: flex; justify-content: center;">
            <a href="{{ route('manager-home', ['type' => 'upcoming']) }}" type="button" class="btn btn-primary {{ $type == 'upcoming' ? 'disabled' : '' }}" style="margin-right: 10px;">Upcoming</a>
            <a href="{{ route('manager-home', ['type' => 'past']) }}" type="button" class="btn btn-primary {{ $type == 'past' ? 'disabled' : '' }}">Past</a>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row justify-content-center">
            @if($tournaments->isEmpty())
                <p class="text-center">No tournaments available to register.</p>
            @else
                @foreach($tournaments as $tournament)
                    <div class="col-md-4 d-flex justify-content-center mb-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $tournament->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $tournament->date }}, {{ $tournament->location }}</h6>
                                <p class="card-text">{{ $tournament->type }}, {{ $tournament->format }}</p>
                                <div class="dropdown d-flex justify-content-end mt-3">
                                <a class="dropdown-item" href="{{ route('manager-match', $tournament->id) }}">View</a>

                                    @if($type == 'past' || $tournament->registeredTeamsCount >= 8)
                                        <button class="btn btn-secondary" disabled>Register</button>
                                    @else
                                        <a class="dropdown-item" href="{{ route('registertour', $tournament->id) }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('register-form-{{ $tournament->id }}').submit();">
                                            Register
                                        </a>
                                        <form id="register-form-{{ $tournament->id }}" action="{{ route('registertour', $tournament->id) }}" method="post" style="display: none;">
                                            @csrf
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="teamRegisteredModal" tabindex="-1" aria-labelledby="teamRegisteredModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="teamRegisteredModalLabel">Registration Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The tournament has reached the maximum number of registered teams (8). You cannot register for this tournament.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('showModal'))
            var myModal = new bootstrap.Modal(document.getElementById('teamRegisteredModal'), {
                keyboard: false
            });
            myModal.show();
        @endif
    });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z5OVQAIhE6TLzj0NBPt6d63V6ME2OWBq4aytdgjdf6YRGY16Gv48kGJlI5JLs3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</main>
</body>
</html>
