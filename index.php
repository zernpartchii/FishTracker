<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishTracker - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/customize.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./assets/img/fishLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/login.css">
    <script src="./assets/js/jquery.js"></script>
    <script defer src="./assets/js/sweetAlert.js"></script>
    <script defer src="./assets/js/fishMoving.js"></script>
    <script defer src="./backend/login/login.js"></script>
</head>

<body>
    <!-- Fullscreen fish layer -->
    <div class="background-fish" id="fishLayer"></div>

    <!-- Login form -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-transparent border-0 login-card p-4">
                    <div class="card-body">
                        <div class="flex-center gap-3 mb-4">
                            <img src="./assets/img/fishLogo.png">
                            <h3 class="text-center m-0">FishTracker Login</h3>
                        </div>
                        <form id="loginForm">
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control-custom" required
                                    placeholder="">
                                <label for="email" class="form-label-custom">Username or Email</label>
                            </div>
                            <div class="form-group m-0">
                                <input type="password" name="password" id="password" class="form-control-custom"
                                    required placeholder="">
                                <label for="password" class="form-label-custom">Password</label>
                            </div>
                            <!-- Show Password Toggle -->
                            <div class="mb-3">
                                <input type="checkbox" id="showPassword" class="form-check-input me-1"
                                    onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'">
                                <label for="showPassword">Show Password</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg btn-orange login">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-3 mb-0">
                            <a href="#" class="text-decoration-none text-danger">Forgot Password?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>