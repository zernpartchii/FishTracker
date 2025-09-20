
document.addEventListener("DOMContentLoaded", () => {
    let user = JSON.parse(localStorage.getItem("user"));
    if (user) {
        document.getElementById("email").value = user.email || "";
        document.getElementById("username").value = user.username || "";
    }

    // ✅ Handle "Change Username"
    document.getElementById("changeUsernameBtn").addEventListener("click", () => {
        Swal.fire({
            title: "Change Username",
            input: "text",
            inputLabel: "New Username",
            inputPlaceholder: "Enter new username",
            confirmButtonText: "Update Username",
            confirmButtonColor: "#FA8A5F",
            cancelButtonText: "Cancel",
            cancelButtonColor: "#6c757d",
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "Username cannot be empty!";
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("../backend/account/updateUsername.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: new URLSearchParams({
                        email: user.email,
                        newUsername: result.value
                    })
                })
                    .then(res => res.text())
                    .then(data => {
                        if (data === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Username Updated!",
                                text: "Please log in again with your new username.",
                                confirmButtonColor: "#FA8A5F",
                            }).then(() => {
                                // 🔐 Logout after username change
                                localStorage.removeItem("user");
                                window.location.href = "./";
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data,
                                confirmButtonColor: "#FA8A5F",
                            });
                        }
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: "error",
                            title: "Request Failed",
                            text: "Something went wrong: " + err,
                            confirmButtonColor: "#FA8A5F",
                        });
                    });
            }
        });
    });
});