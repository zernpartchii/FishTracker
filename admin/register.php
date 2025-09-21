<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishTracker - Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/customize.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/fishLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="../assets/js/jquery.js"></script>
    <script defer src="../assets/js/sweetAlert.js"></script>
    <script defer src="../assets/js/fishMoving.js"></script>
    <script defer src="../backend/account/js/createAccount.js"></script>
</head>

<body>
    <!-- Fullscreen fish layer -->
    <div class="background-fish" id="fishLayer"></div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-transparent border-0 shadow rounded-4 login-card">
                    <div class="card-body p-4">
                        <div class="flex-center gap-3 mb-4">
                            <img src="../assets/img/fishLogo.png">
                            <h3 class="text-center m-0">FishTracker Register</h3>
                        </div>
                        <form id="registerForm">

                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control"
                                        minlength="8" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordHelp" class="form-text">Minimum 8 characters</div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3 position-relative">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" id="confirmPassword" name="confirmPassword"
                                        class="form-control" minlength="8" required>
                                    <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg btn-orange login">Register</button>
                            </div>
                            <a href="../admin/index.php"
                                class="text-decoration-none text-orange btn btn-outline-orange mt-3 w-100">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>