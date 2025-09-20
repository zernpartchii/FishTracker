// Function to show a page
function showPage(page) {
    // Hide all pages
    document.querySelectorAll(".page").forEach(p => p.classList.add("d-none"));

    // Show selected page
    document.querySelector(".page-" + page).classList.remove("d-none");

    // Update active nav-link
    document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));
    document.querySelector('[data-page="' + page + '"]').classList.add("active");
}

// Add click event listeners
document.querySelectorAll(".nav-link").forEach(link => {
    link.addEventListener("click", function (e) {
        e.preventDefault();
        const page = this.getAttribute("data-page");
        showPage(page);

        // Collapse navbar (auto hide) after click
        const navCollapse = document.getElementById("navContent");
        if (navCollapse.classList.contains("show")) {
            const bsCollapse = new bootstrap.Collapse(navCollapse, {
                toggle: true
            });
        }
    });
});

// Default page (dashboard)
showPage("manage-fish");



function checkLogin() {
    let user = localStorage.getItem("user");
    if (!user) {
        Swal.fire({
            title: "You are not logged in",
            text: "Please login to continue",
            icon: "warning",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "./"; // login page
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", () => {
    checkLogin();

    // ✅ Logout handler
    document.getElementById("logoutBtn").addEventListener("click", () => {
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
                localStorage.removeItem("user"); // clear session
                window.location.href = "./"; // go back to login
            }
        });
    });
});

// Handle back/forward navigation
window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        checkLogin();
    }
});