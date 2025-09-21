
// Show/Hide password toggle
document.getElementById("togglePassword").addEventListener("click", function () {
    const passField = document.getElementById("password");
    const icon = this.querySelector("i");
    if (passField.type === "password") {
        passField.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        passField.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    }
});

document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
    const passField = document.getElementById("confirmPassword");
    const icon = this.querySelector("i");
    if (passField.type === "password") {
        passField.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        passField.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    }
});

// ✅ Form validation
document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password.length < 8) {
        Swal.fire("Error", "Password must be at least 8 characters long.", "error");
        return;
    }

    if (password !== confirmPassword) {
        Swal.fire("Error", "Passwords do not match.", "error");
        return;
    }

    // ✅ Send data to backend (register.php)
    fetch("../backend/account/php/createAccount.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            username: username,
            email: email,
            password: password
        })
    })
        .then(res => res.text())
        .then(data => {
            if (data === "success") {
                Swal.fire("Success", "Account created successfully!", "success")
                    .then(() => window.location.href = "admin/index.php"); // redirect to login
            } else {
                Swal.fire("Error", data, "error");
            }
        })
        .catch(err => {
            Swal.fire("Error", "Something went wrong: " + err, "error");
        });
});

/* ✅ Redirect if already logged in */
let role = localStorage.getItem("role");
if (role !== "admin") {
    window.location.href = "../";
}