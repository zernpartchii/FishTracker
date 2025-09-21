$(document).ready(function () {
    $("#loginForm").submit(function (e) {
        e.preventDefault(); // stop form from reloading

        $.ajax({
            url: "backend/login/php/getUser.php",
            type: "POST",
            data: {
                email: $("#email").val(),
                password: $("#password").val()
            },
            success: function (response) {
                if (response.includes("success")) {
                    // ✅ Redirect if success 
                    let user = JSON.parse(response);
                    if (user.role === "user") {
                        localStorage.setItem("user", response);
                        window.location.href = "fish-tracker.php";
                    } else {
                        localStorage.setItem("role", user.role);
                        window.location.href = "admin/index.php";
                    }
                } else {
                    // ❌ Show error
                    Swal.fire({
                        title: "Error",
                        text: response,
                        icon: "error",
                        confirmButtonColor: "#FA8A5F", // 🔸 Orange button
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: " + error);
                $("#message").text("Something went wrong.");
            }
        });
    });
});

/* ✅ Redirect if already logged in */
let user = localStorage.getItem("user");
if (user) {
    window.location.href = "fish-tracker.php";
}