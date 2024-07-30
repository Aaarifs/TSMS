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
        <a href="home-upcoming.html" type="button" class="btn btn-secondary" style="margin-top: 10px; margin-right: 10px;">Players</a>
        <button type="button" class="btn btn-secondary disabled" style="margin-top: 10px; margin-right: 10px;">Tournament</button>
        <a href="home-upcoming.html" type="button" class="btn btn-secondary" style="margin-top: 10px; ">History</a>
      </div>
      
      <div class="d-flex justify-content-center">
        <hr style="width: 50%;">
      </div>
      <div class="container-expand-lg px-0" style="display: flex; justify-content: center;">
        <a href="home-upcoming.html" type="button" class="btn btn-primary" style="margin-right: 10px; margin-top: 10px;">Upcoming</a>
        <button type="button" class="btn btn-primary disabled" style="margin-top: 10px;">Past</button>
      </div>

    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-4 d-flex justify-content-center mb-4">
          <div class="card" style="width: 18rem;">
            <div class="card-body text-center d-flex flex-column">
              <h5 class="card-title">Single Gender Ultimate Challenge</h5>
              <h6 class="card-subtitle mb-2 text-muted">May 18, Selangor</h6>
              <p class="card-text">Gender, Indoor</p>
              <a href="tournament-info.html" class="card-link mb-3">More info</a>
              <div class="mt-auto">
                <button class="btn btn-primary" type="button">Join Tournament</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center mb-4">
          <div class="card" style="width: 18rem;">
            <div class="card-body text-center d-flex flex-column">
              <h5 class="card-title">KGT Ultimate Indoor Open</h5>
              <h6 class="card-subtitle mb-2 text-muted">May 11, Selangor</h6>
              <p class="card-text">Mixed, Indoor</p>
              <a href="tournament-info.html" class="card-link mb-3">More info</a>
              <div class="mt-auto">
                <button class="btn btn-primary" type="button">Join Tournament</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center mb-4">
          <div class="card" style="width: 18rem;">
            <div class="card-body text-center d-flex flex-column">
              <h5 class="card-title">King Of The North</h5>
              <h6 class="card-subtitle mb-2 text-muted">May 4, Pulau Pinang</h6>
              <p class="card-text">Mixed, Outdoor</p>
              <a href="tournament-info.html" class="card-link mb-3">More info</a>
              <div class="mt-auto">
                <button class="btn btn-primary" type="button">Join Tournament</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- JS Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z5OVQAIhE6TLzj0NBPt6d63V6ME2OWBq4aytdgjdf6YRGY16Gv48kGJlI5JLs3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+t9X29pVoIo5D8Im5UPxB+1dJ5xpr+A8bW+Je0M" crossorigin="anonymous"></script>
  </main>
</body>
</html>
