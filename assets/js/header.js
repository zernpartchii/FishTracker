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
showPage("sales-entry");