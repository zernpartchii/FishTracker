var salesDataSet = [
    // 2025 Sales
    ['ORD-001', '2025/09/01', 'Juan Dela Cruz', 'Fighting Fish', 'Betta', 3, 150],
    ['ORD-002', '2025/09/05', 'Maria Santos', 'Molly', 'Livebearer', 5, 300],
    ['ORD-003', '2025/09/10', 'Pedro Reyes', 'Goldfish', 'Carp', 2, 200],
    ['ORD-004', '2025/09/13', 'Ana Lopez', 'Guppy', 'Livebearer', 10, 400],
    ['ORD-005', '2025/09/14', 'Jose Cruz', 'Oscar', 'Cichlid', 1, 500],
    ['ORD-006', '2025/09/15', 'Liza Dizon', 'Platy', 'Livebearer', 4, 160],
    ['ORD-007', '2025/09/16', 'Mark Lim', 'Koi', 'Carp', 2, 1000],
    ['ORD-008', '2025/09/18', 'Ella Ramos', 'Swordtail', 'Livebearer', 6, 240],
    ['ORD-009', '2025/09/20', 'Carlo Cruz', 'Tilapia', 'Cichlid', 8, 800],
    ['ORD-010', '2025/09/22', 'Rosa Medina', 'Angelfish', 'Cichlid', 2, 300],

    // 2024 Sales
    ['ORD-011', '2024/08/15', 'Juan Dela Cruz', 'Betta', 'Fighting Fish', 5, 120],
    ['ORD-012', '2024/07/02', 'Maria Santos', 'Molly', 'Livebearer', 3, 200],
    ['ORD-013', '2024/05/11', 'Pedro Reyes', 'Goldfish', 'Carp', 7, 180],
    ['ORD-014', '2024/12/10', 'Year End Buyer', 'Arowana', 'Osteoglossidae', 1, 5000],
    ['ORD-015', '2024/11/22', 'Ana Lopez', 'Oscar', 'Cichlid', 2, 450],

    // 2023 Sales
    ['ORD-016', '2023/03/05', 'Old Customer', 'Catfish', 'Cichlid', 3, 250],
    ['ORD-017', '2023/04/12', 'Juan Dela Cruz', 'Tilapia', 'Cichlid', 6, 100],
    ['ORD-018', '2023/06/30', 'Maria Santos', 'Swordtail', 'Livebearer', 4, 150],
    ['ORD-019', '2023/09/01', 'Pedro Reyes', 'Koi', 'Carp', 1, 2000],
    ['ORD-020', '2023/10/18', 'Ana Lopez', 'Guppy', 'Livebearer', 10, 90],
];

var table = new DataTable('#tableSales', {
    columns: [
        { title: 'Order ID' },
        { title: 'Sales Date' },
        { title: 'Customer Name' },
        { title: 'Fish Name' },
        { title: 'Type' },
        { title: 'Qty' },
        {
            title: 'Price',
            render: function (data) {
                return '₱' + data.toLocaleString();
            }
        },
        {
            title: 'Total Price',
            render: function (data, type, row) {
                let qty = row[5];
                let price = row[6];
                return '₱' + (qty * price).toLocaleString();
            }
        }
    ],
    data: salesDataSet,
    destroy: true, // ✅ allow re-initialization 
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
});

// // Get unique years from dataSet
// // Get unique years from salesDataSet
// const years = [...new Set(salesDataSet.map(row => new Date(row[1]).getFullYear()))].sort((a, b) => b - a);


// const yearSelect = document.getElementById("yearFilter");

// // Add "All Years" option
// // const allOption = document.createElement("option");
// // allOption.value = "all";
// // allOption.textContent = "All Years";
// // yearSelect.appendChild(allOption);

// // Add options dynamically
// years.forEach(year => {
//     const option = document.createElement("option");
//     option.value = year;
//     option.textContent = year;

//     // Optional: make current year selected by default
//     if (year === new Date().getFullYear()) {
//         option.selected = true;
//     }

//     yearSelect.appendChild(option);
// });

// function calculateTotals(filterYear) {
//     // convert filterYear to number if it's not "all"
//     let yearNum = filterYear === "all" ? null : Number(filterYear);

//     let weeklyTotal = 0;
//     let monthlyTotal = 0;
//     let yearlyTotal = 0;

//     let now = new Date();
//     let currentMonth = now.getMonth();

//     let weekStart = new Date(now);
//     weekStart.setDate(now.getDate() - now.getDay() + 1); // Monday
//     weekStart.setHours(0, 0, 0, 0);

//     let weekEnd = new Date(weekStart);
//     weekEnd.setDate(weekStart.getDate() + 6);
//     weekEnd.setHours(23, 59, 59, 999);

//     let filteredData = salesDataSet.filter(row => {
//         let rowYear = new Date(row[1]).getFullYear();
//         return yearNum === null || rowYear === yearNum;
//     });

//     // Clear and reload table
//     table.clear();
//     table.rows.add(filteredData).draw();

//     // Calculate totals
//     filteredData.forEach(row => {
//         let date = new Date(row[1]);
//         let qty = Number(row[5]);
//         let price = Number(row[6]);
//         let total = qty * price;

//         yearlyTotal += total;

//         if (date.getMonth() === currentMonth) monthlyTotal += total;
//         if (date >= weekStart && date <= weekEnd) weeklyTotal += total;
//     });

//     document.getElementById("weeklyTotal").textContent = "₱" + weeklyTotal.toLocaleString();
//     document.getElementById("monthlyTotal").textContent = "₱" + monthlyTotal.toLocaleString();
//     document.getElementById("yearlyTotal").textContent = "₱" + yearlyTotal.toLocaleString();
// }

// document.getElementById("yearFilter").addEventListener("change", function () {
//     document.getElementById("monthFilter").value = "all";
//     document.getElementById("monthFilter").selectedIndex = 0;
//     table.search("").draw();
//     let selectedYear = this.value;
//     calculateTotals(selectedYear);
// });

// document.getElementById("monthFilter").addEventListener("change", function () {
//     const yearFilter = document.getElementById("yearFilter");
//     let selectedMonth = this.value;
//     if (selectedMonth === "all") {
//         table.search(yearFilter.value).draw();
//     } else {
//         table.search(yearFilter.value + "/" + selectedMonth).draw();
//         // calculateTotals(yearFilter.value);
//     }
// });


// // Initial load
// calculateTotals(new Date().getFullYear());
