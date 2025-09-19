document.getElementById("profitYear").textContent = new Date().getFullYear();

const ctx = document.getElementById('chartProfit');

// Your dataset
const profitData = [340, 280, 320, 110, 360, 220, 480, 100, 520, 600, 580, 440];

// 🔥 Calculate total
const totalProfit = profitData.reduce((sum, val) => sum + val, 0);

// Update the label dynamically
document.getElementById("profitTotal").textContent = "₱ " + totalProfit.toLocaleString();

// Calculate growth from last month
const last = profitData[profitData.length - 1]; // December = 640
const prev = profitData[profitData.length - 2]; // November = 580
const growthRate = ((last - prev) / prev) * 100;

// Update badge
const growthBadge = document.getElementById("profitGrowth");
growthBadge.textContent = (growthRate >= 0 ? "+" : "") + growthRate.toFixed(1) + "%";

// Optional: change badge color depending on positive/negative
if (growthRate >= 0) {
    growthBadge.classList.remove("bg-danger", "text-light");
    growthBadge.classList.add("bg-warning", "text-success");
} else {
    growthBadge.classList.remove("bg-warning", "text-success");
    growthBadge.classList.add("bg-danger", "text-light");
}

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            data: profitData,
            borderWidth: 1,
            borderColor: '#eee', // line color
            backgroundColor: 'rgba(255, 255, 255, 0.1)', // ✅ transparent fill
            fill: true,
            tension: 0.4,
            pointBackgroundColor: profitData.map((value, index) => {
                if (index === 0) return 'green'; // first month default green
                return value >= profitData[index - 1] ? '#23922E' : '#DC3545';
            }),
            pointRadius: 5 // optional: make points visible
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // 🔥 allow chart to stretch
        plugins: {
            legend: {
                display: false // ✅ hide the label
            }
        },
        scales: {
            x: {
                grid: {
                    display: false, // ✅ remove x grid lines
                    drawBorder: false
                },
                ticks: {
                    display: true, // hide x labels if you want
                    color: "#fff" // ✅ make them white
                },
                display: true // ✅ no x-axis, no extra space
            },
            y: {
                grid: {
                    display: false, // ✅ remove y grid lines
                    drawBorder: false
                },
                ticks: {
                    display: true, // hide y labels if you want
                    color: "#fff" // ✅ make them white
                },
                display: true, // ✅ no y-axis, no extra space
                beginAtZero: true
            }
        }
    }
});