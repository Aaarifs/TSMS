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

    <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header" style="width: 100%; background-color:#0866FF;">
                <h3 class="text-white text-center">Create Tournament</h3>
              </div>
              <div class="card-body">
                <form action="{{ route('tournaments.store') }}" method="post">
                  @csrf
                  <div class="form-group mb-3">
                    <label for="TournamentName">Tournament Name</label>
                    <input type="text" class="form-control" id="TournamentName" name="TournamentName" required>
                  </div>
                  <div class="form-group mb-3">
                    <label for="TournamentDate">Tournament Date</label>
                    <input type="date" class="form-control" id="TournamentDate" name="TournamentDate">
                  </div>                  
                  <div class="form-group mb-3">
                    <label for="TournamentLocation">Tournament Location</label>
                    <select class="form-select" id="TournamentLocation" name="TournamentLocation" required>
                      <option value="" disabled selected>Select Tournament Location</option>
                      <option value="Johor">Johor</option>
                      <option value="Kedah">Kedah</option>
                      <option value="Kelantan">Kelantan</option>
                      <option value="Melaka">Melaka</option>
                      <option value="Negeri Sembilan">Negeri Sembilan</option>
                      <option value="Pahang">Pahang</option>
                      <option value="Penang">Penang</option>
                      <option value="Perak">Perak</option>
                      <option value="Perlis">Perlis</option>
                      <option value="Sabah">Sabah</option>
                      <option value="Sarawak">Sarawak</option>
                      <option value="Selangor">Selangor</option>
                      <option value="Terengganu">Terengganu</option>
                    </select>
                  </div>                
                  <div class="form-group mb-3">
                    <label for="TournamentType">Tournament Type</label>
                    <select class="form-select" id="TournamentType" name="TournamentType" required>
                      <option value="" disabled selected>Select Tournament Type</option>
                      <option value="Mixed">Mixed Gender</option>
                      <option value="Single">Single Gender</option>
                    </select>
                  </div>  
                  <div class="form-group mb-3">
                    <label for="TournamentFormat">Tournament Format</label>
                    <select class="form-select" id="TournamentFormat" name="TournamentFormat" required>
                      <option value="" disabled selected>Select Tournament Format</option>
                      <option value="Indoor">Indoor</option>
                      <option value="Outdoor">Outdoor</option>
                      <option value="Beach">Beach</option>
                    </select>
                  </div>                                        
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="submit-btn">Update Tournament</button>
                  </div>
                </form>
              </div>
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