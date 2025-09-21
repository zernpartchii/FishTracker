<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - User Accounts</title>
    <link rel="shortcut icon" href="../assets/img/fishLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-4">User Accounts</h2>
            <button type="button" class="btn btn-danger btnLogout">Logout</button>
        </div>

        <p class="text-center mt-3 mb-0">
            Dont have an account? <a href="../register.php" class="text-decoration-none text-orange">Register</a>
        </p>

        <table id="usersTable" class="table table-bordered table-striped">
            <thead class="">
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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
                    <input type="hidden" id="user_id" name="user_id">
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


    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
        localStorage.removeItem("role");
        window.location.href = "../";
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
                    data: 'user_id'
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
                          <button class="btn btn-sm btn-secondary" onclick="changePass(${row.user_id})">Change Password</button>
                        `;
                    }
                }
            ]
        });

        // Handle password update
        $("#changePassForm").on("submit", function(e) {
            e.preventDefault();

            $.post("./php/changePass.php", $(this).serialize(), function(response) {
                alert(response);
                $("#changePassModal").modal("hide");
            });
        });
    });

    // Open modal with user id
    function changePass(id) {
        $("#user_id").val(id);
        $("#new_password").val("");
        $("#changePassModal").modal("show");
    }
    </script>
</body>

</html>