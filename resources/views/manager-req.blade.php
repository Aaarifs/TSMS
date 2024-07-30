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
        <a href="home-upcoming.html" type="button" class="btn btn-secondary disabled " style="margin-top: 10px; margin-right: 10px;">Players</a>
        <a href="home-upcoming.html" type="button" class="btn btn-secondary" style="margin-top: 10px; margin-right: 10px;">Tournament</a>
        <a href="home-upcoming.html" type="button" class="btn btn-secondary" style="margin-top: 10px; ">History</a>
      </div>
      <div class="d-flex justify-content-center">
        <hr style="width: 50%;">
      </div>

      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header" style="width: 100%; background-color:#0866FF;">
                <a href="previous-page.html" class="btn btn-link position-absolute text-white" style="left: 10px; text-decoration: none;">&lt; Back</a>
                <h3 class="text-white text-center">New Player Request</h3>
              </div>
  
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="text-center">
                        <th>Player Name</th>
                        <th>Request Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="text-center">
                        <td>Muhammad Hafiz</td>
                        <td>16/05/2024</td>
                        <td>
                          <button type="button" class="btn btn-success">Approve</button>
                          <button type="button" class="btn btn-danger">Decline</button>
                        </td>
                      </tr>
                      <tr class="text-center">
                        <td>Joshua Chiew</td>
                        <td>18/05/2024</td>
                        <td>
                          <button type="button" class="btn btn-success">Approve</button>
                          <button type="button" class="btn btn-danger">Decline</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
