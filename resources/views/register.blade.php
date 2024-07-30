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
          <div class="card-header" style="width: 100%; background-color:#0866FF;">
            <a href="{{ route('login') }}" class="btn btn-link position-absolute text-white" style=" text-decoration: none;">&lt; Back</a>
            <h3 class="text-white text-center">Create Account</h3>
          </div>
          <div class="card-body">
            <form id="create-account-form" action="{{ route('register-store') }}" method="post">
              @csrf
              <div class="form-group mb-3">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="fullname" required>
              </div>
              <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group mb-3">
                <label for="phone_number">Phone Number</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
              </div>
              <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
              </div>
              <div class="form-group mb-3">
                <label for="account_type">Account Type:</label>
                <select class="form-control" id="account_type" name="account_type" required>
                  <option value="" disabled selected>Select Account Type</option>
                  <option value="player">Player</option>
                  <option value="teammanager">Team Manager</option>
                  <option value="organiser">Organiser</option>
                </select>
              </div>
              <div class="form-group mb-3" id="team-name-group" style="display: none;">
                <label for="team_name">Team Name</label>
                <input type="text" class="form-control" id="team_name" name="team_name">
              </div>
              <div class="text-center">
                <button type="button" class="btn btn-primary" id="submit-btn">Create Account</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Confirmation Modal -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Confirm Account Creation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Please review your details:</p>
          <ul id="confirmation-details"></ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="confirm-btn">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7/z5OVQAIhE6TLzj0NBPt6d63V6ME2OWBq4aytdgjdf6YRGY16Gv48kGJlI5JLs3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    document.getElementById('account_type').addEventListener('change', function() {
      const teamNameGroup = document.getElementById('team-name-group');
      if (this.value === 'teammanager') {
        teamNameGroup.style.display = 'block';
        document.getElementById('team_name').setAttribute('required', 'required');
      } else {
        teamNameGroup.style.display = 'none';
        document.getElementById('team_name').removeAttribute('required');
      }
    });

    document.getElementById('submit-btn').addEventListener('click', function() {
      // Collect form data
      const fullName = document.getElementById('full_name').value;
      const email = document.getElementById('email').value;
      const phoneNumber = document.getElementById('phone_number').value;
      const password = document.getElementById('password').value;
      const accountType = document.getElementById('account_type').value;
      const teamName = document.getElementById('team_name').value;

      // Display form data in the confirmation modal
      const confirmationDetails = document.getElementById('confirmation-details');
      confirmationDetails.innerHTML = `
        <li>Full Name: ${fullName}</li>
        <li>Email: ${email}</li>
        <li>Phone Number: ${phoneNumber}</li>
        <li>Account Type: ${accountType}</li>
        ${accountType === 'teammanager' ? `<li>Team Name: ${teamName}</li>` : ''}
      `;

      // Show the confirmation modal
      var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
      confirmationModal.show();
    });

    document.getElementById('confirm-btn').addEventListener('click', function() {
      // Submit the form when the confirm button is clicked
      document.getElementById('create-account-form').submit();
    });
  </script>
</body>
</html>
