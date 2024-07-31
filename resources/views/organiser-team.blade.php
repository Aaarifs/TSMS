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
        </ul>
      </div>
    </div>
  </nav>

  <main style="display: flex; flex-direction: column; min-height: 15vh;">

    <div class="col-md-8 mx-auto">
      <div class="container-expand-lg px-0" style="display: flex; justify-content: center;">
      <a href="{{ route('organiser-match', $tournament->id) }}" class="btn btn-primary " style="margin-right: 10px; margin-top: 10px;">Match</a>
        <a href="{{ route('organiser-standings', $tournament->id) }}" class="btn btn-primary " style="margin-right: 10px; margin-top: 10px;">Standings</a>
        <a href="{{ route('organiser-team', $tournament->id) }}" class="btn btn-primary disabled" style="margin-top: 10px;">Teams</a>
      </div>
    </div>
    
    <div class="d-flex justify-content-center">
      <hr style="width: 50%;">
    </div>

    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="width: 100%; background-color:#0866FF;">
              <div class="d-flex flex-grow-1 justify-content-center position-relative">
                <h3 class="text-white text-center">Teams</h3>
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
                            <th>Team Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $teammanager)
                      <tr>
        
                        <td><a href="{{ route('organiser-team-players', $team->id) }}">{{ $team->team_name }}</a></td>                        
                      </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z5OVQAIhE6TLzj0NBPt6d63V6ME2OWBq4aytdgjdf6YRGY16Gv48kGJlI5JLs3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script></body>
</html>
