$(document).ready(function () {
    $("#loginForm").submit(function (e) {
        e.preventDefault(); // stop form from reloading

        $.ajax({
            url: "backend/login/getUser.php",
            type: "POST",
            data: {
                email: $("#email").val(),
                password: $("#password").val()
            },
            success: function (response) {
                if (response.includes("success")) {
                    // ✅ Redirect if success
                    // store response in localStorage
                    localStorage.setItem("user", response);
                    window.location.href = "fish-tracker.php";
                } else {
                    // ❌ Show error
                    Swal.fire({
                        title: "Sorry",
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