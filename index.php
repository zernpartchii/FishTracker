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
    <script defer src="./assets/js/login.js"></script>
    <style>
    body {
        margin: 0;
        /* background: linear-gradient(to right, #EF9E28, #FA8A5F); */
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .background-fish {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
    }

    .fish {
        position: absolute;
        width: 60px;
        opacity: 0.9;
        pointer-events: none;
        will-change: transform;
    }

    .login-card {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 10;
        background: white;
    }
    </style>
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
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <input type="text" id="email" class="form-control-custom" required placeholder="">
                                <label for="email" class="form-label-custom">Username or Email</label>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" class="form-control-custom" required
                                    placeholder="">
                                <label for="password" class="form-label-custom">Password</label>
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