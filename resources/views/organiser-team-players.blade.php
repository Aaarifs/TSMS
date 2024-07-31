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
  <a href="{{ route('organiser-team') }}" class="btn btn-link position-absolute text-white" style=" text-decoration: none;">&lt; Back</a>
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
      <a href="{{ route('organiser-team') }}" type="button" class="btn btn-secondary" style="margin-top: 10px;">Back to Teams</a>
    </div>
    <div class="d-flex justify-content-center">
        <hr style="width: 50%;">
    </div>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center">{{ $team->name }}</h2>
                <h5 class="text-center mb-4">Players</h5>
                @if($players->isEmpty())
                    <p class="text-center">No players in this team.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Player Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($players as $player)
                                <tr>
                                    <td>{{ $player->fullname }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z5OVQAIhE6TLzj0NBPt6d63V6ME2OWBq4aytdgjdf6YRGY16Gv48kGJlI5JLs3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script></body>
</html>
