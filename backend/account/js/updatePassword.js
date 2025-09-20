
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
            html: '<input id="swal-old" type="password" class="form-control mb-2" placeholder="Current Password">' +
                '<input id="swal-new" type="password" class="form-control mb-2" placeholder="New Password">' +
                '<input id="swal-confirm" type="password" class="form-control" placeholder="Confirm New Password">',
            focusConfirm: false,
            confirmButtonText: "Update Password",
            confirmButtonColor: "#FA8A5F",
            cancelButtonText: "Cancel",
            cancelButtonColor: "#6c757d",
            showCancelButton: true,
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
                                window.location.href =
                                    "./"; // go back to login page
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