<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Accounts</title>

    <link rel="shortcut icon" href="../assets/img/fishLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/customize.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/style.css">


    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

    <script defer src="../assets/bootstrap/bootstrap.min.js"></script>
    <script defer src="../assets/js/sweetAlert.js"></script>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg bg-body mb-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-muted" href="#">
                <img src="../assets/img/fishLogo.png" class="img-fluid" width="40">
                <span class="ms-2">FishTracker</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent"
                aria-controls="navContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    </li>
                </ul>
                <div class="ms-auto">
                    <button class="btn btn-orange bi bi-box-arrow-right btnLogout"> Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">User Accounts</h2>
        <p>
            Dont have an account? <a href="../register.php" class="text-decoration-none text-orange">Register</a>
        </p>
        <div class="table-responsive m-0 p-0">
            <table id="usersTable" class="table table-bordered table-striped m-0 p-0">
                <thead class="">
                    <tr>
                        <th>UserID</th>
                        <th>role</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- 🔥 Change Password Modal -->
    <div class="modal fade" id="changePassModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="changePassForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="userID" name="userID">
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update Password</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    let table;

    // Show/Hide password toggle
    $(document).on("click", "#togglePassword", function() {
        const passwordField = $("#new_password");
        const type = passwordField.attr("type") === "password" ? "text" : "password";
        passwordField.attr("type", type);

        // ✅ Toggle between bi-eye and bi-eye-slash
        $(this).find("i").toggleClass("bi-eye bi-eye-slash");
    });

    /* Logout */
    $(document).on("click", ".btnLogout", function() {
        Swal.fire({
            title: "Logout?",
            text: "Are you sure you want to logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Logout",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#FA8A5F", // 🔸 Orange button
            cancelButtonColor: "#6c757d" // 🔹 Gray button
        }).then((result) => {
            if (result.isConfirmed) {
                localStorage.removeItem("role");
                window.location.href = "../";
            }
        })
    });

    /* ✅ Redirect if already logged in */
    let role = localStorage.getItem("role");
    if (role !== "admin") {
        window.location.href = "../";
    }

    $(document).ready(function() {
        table = $('#usersTable').DataTable({
            ajax: {
                url: './php/getUsers.php',
                dataSrc: ''
            },
            columns: [{
                    data: 'userID'
                },
                {
                    data: 'role'
                },
                {
                    data: 'email'
                },
                {
                    data: 'username'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        <div class="d-flex gap-2">
                          <button class="btn btn-sm btn-secondary" onclick="changePass(${row.userID})">Change</button>
                          <button class="btn btn-sm btn-danger" ${row.role === 'admin' ? 'disabled' : ''} onclick="deleteUser(${row.userID})">Delete</button>
                        </div>
                        `;
                    }
                }
            ]
        });

        // Handle password update
        $("#changePassForm").on("submit", function(e) {
            e.preventDefault();

            $.post("./php/changePass.php", $(this).serialize(), function(response) {
                if (response === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Password updated successfully",
                        confirmButtonColor: '#FA8A5F',
                    })
                    $("#changePassModal").modal("hide");
                } else if (response === "error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "Error updating password",
                        confirmButtonColor: '#FA8A5F',
                    })
                    $("#changePassModal").modal("hide");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "Something went wrong",
                        confirmButtonColor: '#FA8A5F',
                    })
                    $("#changePassModal").modal("hide");
                }
            });
        });
    });

    // Open modal with user id
    function changePass(id) {
        $("#userID").val(id);
        $("#new_password").val("");
        $("#changePassModal").modal("show");
    }

    // Delete user
    function deleteUser(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FA8A5F',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("./php/deleteUser.php", {
                    userID: id
                }, function(response) {
                    table.ajax.reload();
                });
            }
        });
    }
    </script>
</body>

</html>