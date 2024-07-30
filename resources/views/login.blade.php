<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
                        <h3 class="text-white text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login-store') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                                <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
