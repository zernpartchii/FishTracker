
document.addEventListener("DOMContentLoaded", () => {
    let user = JSON.parse(localStorage.getItem("user"));
    if (user) {
        document.getElementById("email").value = user.email || "";
        document.getElementById("username").value = user.username || "";
    }

    // ✅ Handle "Change Password"
    document.getElementById("newPasswordBtn").addEventListener("click", () => {
        Swal.fire({
            title: "Change Password",
            html: `
                <div class="input-group mb-2">
                    <input id="swal-old" type="password" class="form-control" placeholder="Current Password">
                    <button type="button" class="btn btn-outline-secondary bi-eye" id="toggle-old"></button>
                </div>
                <div class="input-group mb-2">
                    <input id="swal-new" type="password" class="form-control" placeholder="New Password">
                    <button type="button" class="btn btn-outline-secondary bi-eye" id="toggle-new"></button>
                </div>
                <div class="input-group">
                    <input id="swal-confirm" type="password" class="form-control" placeholder="Confirm New Password">
                    <button type="button" class="btn btn-outline-secondary bi-eye" id="toggle-confirm"></button>
                </div>
            `,
            focusConfirm: false,
            confirmButtonText: "Update Password",
            confirmButtonColor: "#FA8A5F",
            cancelButtonText: "Cancel",
            cancelButtonColor: "#6c757d",
            showCancelButton: true, didOpen: () => {
                // Show/hide toggle for old password
                document.getElementById("toggle-old").addEventListener("click", () => {
                    const input = document.getElementById("swal-old");
                    input.type = input.type === "password" ? "text" : "password";
                });
                // Show/hide toggle for new password
                document.getElementById("toggle-new").addEventListener("click", () => {
                    const input = document.getElementById("swal-new");
                    input.type = input.type === "password" ? "text" : "password";
                });
                // Show/hide toggle for confirm password
                document.getElementById("toggle-confirm").addEventListener("click", () => {
                    const input = document.getElementById("swal-confirm");
                    input.type = input.type === "password" ? "text" : "password";
                });
            },
            preConfirm: () => {
                const oldPass = document.getElementById("swal-old").value;
                const newPass = document.getElementById("swal-new").value;
                const confirmPass = document.getElementById("swal-confirm").value;

                if (!oldPass || !newPass || !confirmPass) {
                    Swal.showValidationMessage("All fields are required");
                } else if (newPass !== confirmPass) {
                    Swal.showValidationMessage("New passwords do not match");
                }
                return {
                    oldPass,
                    newPass
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // ✅ Send request to PHP
                fetch("../backend/account/php/updatePassword.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: new URLSearchParams({
                        email: user.email,
                        oldPassword: result.value.oldPass,
                        newPassword: result.value.newPass
                    })
                })
                    .then(res => res.text())
                    .then(data => {
                        if (data === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Password Updated!",
                                text: "Please log in again with your new password.",
                                confirmButtonColor: "#FA8A5F"
                            }).then(() => {
                                // 🔐 Logout after password change
                                localStorage.removeItem("user");
                                window.location.href = "./"; // go back to login page
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data,
                                confirmButtonColor: "#FA8A5F"
                            });
                        }
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: "error",
                            title: "Request Failed",
                            text: "Something went wrong: " + err,
                            confirmButtonColor: "#FA8A5F"
                        });
                    });
            }
        });
    });
});