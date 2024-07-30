<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Pending Requests</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('../image/backgroundtsms.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
  <main style="display: flex; flex-direction: column; min-height: 15vh;">
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header" style="width: 100%; background-color:#0866FF;">
              <a href="{{ route('player-home') }}" class="btn btn-link position-absolute text-white" style="text-decoration: none; left: 10px;">&lt; Back</a>
              <h3 class="text-white text-center">Join Team</h3>
            </div>
            <div class="card-body">
              <form action="{{ route('player-request-submit') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                  <label for="team_name">Team Name:</label>
                  <select class="form-control" id="team_name" name="team_name" required>
                    <option value="">Select Team Name</option>
                    @foreach($teams as $teammanager)
                      <option value="{{ $teammanager->id }}">{{ $teammanager->team_name }}</option>
                    @endforeach
                  </select>
                </div>
                <button type="submit" class="btn btn-primary" >Submit</button>
              </form>
            </div>
          </div>

          <!-- Table for displaying pending requests -->
          <h3 class="text-center mt-5">My Pending Requests</h3>
          <div class="table-responsive">
            
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
