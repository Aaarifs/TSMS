<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Tournament</title>
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

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color:#0866FF;">
                <a href="{{ route('organiser-home') }}" class="btn btn-link position-absolute text-white" style=" text-decoration: none;">&lt; Back</a>

                    <h3 class="text-white text-center">Update Tournament</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('tournaments.update', $tournament->id) }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="TournamentName">Tournament Name</label>
                            <input type="text" class="form-control" id="TournamentName" name="TournamentName" value="{{ $tournament->name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="TournamentDate">Tournament Date</label>
                            <input type="date" class="form-control" id="TournamentDate" name="TournamentDate" value="{{ $tournament->date }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="TournamentLocation">Tournament Location</label>
                            <select class="form-select" id="TournamentLocation" name="TournamentLocation" required>
                                <option value="" disabled>Select Tournament Location</option>
                                <option value="Johor" {{ $tournament->location == 'Johor' ? 'selected' : '' }}>Johor</option>
                                <option value="Kedah" {{ $tournament->location == 'Kedah' ? 'selected' : '' }}>Kedah</option>
                                <option value="Kelantan" {{ $tournament->location == 'Kelantan' ? 'selected' : '' }}>Kelantan</option>
                                <option value="Melaka" {{ $tournament->location == 'Melaka' ? 'selected' : '' }}>Melaka</option>
                                <option value="Negeri Sembilan" {{ $tournament->location == 'Negeri Sembilan' ? 'selected' : '' }}>Negeri Sembilan</option>
                                <option value="Pahang" {{ $tournament->location == 'Pahang' ? 'selected' : '' }}>Pahang</option>
                                <option value="Penang" {{ $tournament->location == 'Penang' ? 'selected' : '' }}>Penang</option>
                                <option value="Perak" {{ $tournament->location == 'Perak' ? 'selected' : '' }}>Perak</option>
                                <option value="Perlis" {{ $tournament->location == 'Perlis' ? 'selected' : '' }}>Perlis</option>
                                <option value="Sabah" {{ $tournament->location == 'Sabah' ? 'selected' : '' }}>Sabah</option>
                                <option value="Sarawak" {{ $tournament->location == 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                                <option value="Selangor" {{ $tournament->location == 'Selangor' ? 'selected' : '' }}>Selangor</option>
                                <option value="Terengganu" {{ $tournament->location == 'Terengganu' ? 'selected' : '' }}>Terengganu</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="TournamentType">Tournament Type</label>
                            <select class="form-select" id="TournamentType" name="TournamentType" required>
                                <option value="" disabled>Select Tournament Type</option>
                                <option value="Mixed" {{ $tournament->type == 'Mixed' ? 'selected' : '' }}>Mixed Gender</option>
                                <option value="Single" {{ $tournament->type == 'Single' ? 'selected' : '' }}>Single Gender</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="TournamentFormat">Tournament Format</label>
                            <select class="form-select" id="TournamentFormat" name="TournamentFormat" required>
                                <option value="" disabled>Select Tournament Format</option>
                                <option value="Indoor" {{ $tournament->format == 'Indoor' ? 'selected' : '' }}>Indoor</option>
                                <option value="Outdoor" {{ $tournament->format == 'Outdoor' ? 'selected' : '' }}>Outdoor</option>
                                <option value="Beach" {{ $tournament->format == 'Beach' ? 'selected' : '' }}>Beach</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Tournament</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z5OVQAIhE6TLzj0NBPt6d63V6ME2OWBq4aytdgjdf6YRGY16Gv48kGJlI5JLs3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
