<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body style="background-image: url('../image/backgroundtsms.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="text-center mb-3">
          <img src="../image/logo (7).png" alt="Login Page Image" class="img-fluid" style="width: 192px; height: 98px;">
        </div>
                <div class="card shadow-lg">
                    <div class="card-header" style="width: 100%; background-color:#0866FF; position: relative;">
                        <a href="{{ route('manager-home') }}" class="btn btn-link position-absolute text-white" style="text-decoration: none; left: 10px;">&lt; Back</a>
                        <h3 class="text-white text-center">Account Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="full_name" class="form-label"><strong>Full Name:</strong></label>
                            <p class="form-control-plaintext">{{ $teammanager->fullname }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong>Email:</strong></label>
                            <p class="form-control-plaintext">{{ $teammanager->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label"><strong>Phone Number:</strong></label>
                            <p class="form-control-plaintext">{{ $teammanager->phone_number }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label"><strong>Team Name:</strong></label>
                            <p class="form-control-plaintext">{{ $teammanager->team_name }}</p>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('manager-updateprof') }}" class="btn btn-primary">Update Account</a>
                        </div>
                    </div>
                </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z5OVQAIhE6TLzj0NBPt6d63V6ME2OWBq4aytdgjdf6YRGY16Gv48kGJlI5JLs3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
