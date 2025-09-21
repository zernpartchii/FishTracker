document.addEventListener("DOMContentLoaded", () => {
    const yearSelect = document.getElementById("yearSelect");

    // Fetch available years from backend
    fetch("./backend/dashboard/php/dashboard.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "action=get_years&userID=" + userID
    })
        .then(res => res.json())
        .then(years => {
            yearSelect.innerHTML = "";
            years.forEach((y, i) => {
                let option = document.createElement("option");
                option.value = y;
                option.textContent = y;
                yearSelect.appendChild(option);
            });

            // Default to first year (latest)
            if (years.length > 0) {
                yearSelect.value = years[0];
                loadFunctions(yearSelect.value);
            }
        });

    // Change event reloads data
    yearSelect.addEventListener("change", () => {
        loadFunctions(yearSelect.value);
    });

    // Initial load
    const currentYear = new Date().getFullYear();
    loadFunctions(yearSelect.value || currentYear);
});

function loadFunctions(year) {
    document.getElementById("profitYear").textContent = year;
    loadTopCustomers(year);
    loadTopFish(year);
    loadTotalSales(year);
    loadTotalItems(year);
    loadProfitChart(year)
    loadFishCount();
}

let profitChart = null; // global variable

async function loadProfitChart(year) {
    const res = await fetch("./backend/dashboard/php/dashboard.php", {
        method: "POST",
        body: new URLSearchParams({ action: "get_monthly_profit", year, userID })
    });

    const data = await res.json();
    const profitData = data.monthlyProfit;

    // 🔥 Destroy existing chart before creating new one
    if (profitChart) {
        profitChart.destroy();
    }


    // ✅ Find the last non-zero month and its previous
    const lastIndex = profitData.map((val, i) => ({ val, i }))
        .reverse()
        .find(item => item.val > 0)?.i;

    let monthGrowth = 0;

    if (lastIndex !== undefined && lastIndex > 0) {
        const last = profitData[lastIndex];          // e.g., Oct = 850
        const prev = profitData[lastIndex - 1] || 0; // e.g., Sep = 450

        monthGrowth = prev > 0 ? ((last - prev) / prev) * 100 : 0;
    }

    // ✅ Update badge
    const growthBadge = document.getElementById("profitGrowth");
    growthBadge.textContent = (monthGrowth >= 0 ? "+" : "") + monthGrowth.toFixed(1) + "% Growth Compared to Last Month";

    // ✅ Badge color
    if (monthGrowth > 0) {
        growthBadge.classList.remove("bg-danger", "text-light", "bg-secondary");
        growthBadge.classList.add("bg-warning", "text-success"); // green badge
    } else if (monthGrowth < 0) {
        growthBadge.classList.remove("bg-warning", "text-success", "bg-secondary");
        growthBadge.classList.add("bg-danger", "text-light"); // red badge
    } else {
        growthBadge.classList.remove("bg-danger", "text-light", "bg-warning", "text-success");
        growthBadge.classList.add("bg-secondary", "text-light"); // neutral
    }

    // ✅ Chart
    profitChart = new Chart(document.getElementById('chartProfit'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                data: profitData,
                borderWidth: 1,
                borderColor: '#eee',
                backgroundColor: 'rgba(255, 255, 255, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: profitData.map((val, i) => {
                    if (val === 0) return 'gray'; // neutral color if no sales
                    if (i === 0) return val === 0 ? 'gray' : 'green'; // Jan special case
                    return val >= profitData[i - 1] ? '#23922E' : '#DC3545';
                }),
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: "#fff" }, grid: { display: false } },
                y: { ticks: { color: "#fff" }, grid: { display: false }, beginAtZero: true }
            }
        }
    });
}

async function loadTotalSales(year) {
    let res = await fetch("./backend/dashboard/php/dashboard.php", {
        method: "POST",
        body: new URLSearchParams({ action: "get_total_sales", year, userID })
    });
    let data = await res.json();

    // Example: show in an element
    document.getElementById("totalSales").textContent =
        `₱ ${parseFloat(data.totalSales).toLocaleString()}`;
}

async function loadTotalItems(year) {
    let res = await fetch("./backend/dashboard/php/dashboard.php", {
        method: "POST",
        body: new URLSearchParams({ action: "get_total_items", year, userID })
    });
    let data = await res.json();

    document.getElementById("totalSold").textContent =
        data.totalItems.toLocaleString();
}

async function loadFishCount() {
    let res = await fetch("./backend/dashboard/php/dashboard.php", {
        method: "POST",
        body: new URLSearchParams({ action: "get_fish_count", userID })
    });
    let data = await res.json();

    document.getElementById("fishCount").textContent = data.totalFish;
}


