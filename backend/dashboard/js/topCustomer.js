function loadTopCustomers(year) {
    fetch("./backend/dashboard/php/topCustomer.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=top_customers&year=${year}&userID=${userID}`
    })
        .then(res => res.json())
        .then(customers => {
            fetchCustomerList(customers); // now dynamic
        });
}

// Function to generate random light color
function getRandomLightColor() {
    const r = Math.floor(Math.random() * 128 + 127);
    const g = Math.floor(Math.random() * 128 + 127);
    const b = Math.floor(Math.random() * 128 + 127);
    return `rgb(${r}, ${g}, ${b})`;
}

function fetchCustomerList(customers) {
    const list = document.getElementById("customerList");
    list.innerHTML = "";

    if (customers.length === 0) {
        const li = document.createElement("li");
        li.className = "list-group-item d-flex align-items-center justify-content-between";
        li.textContent = "No Available data for this year.";
        list.appendChild(li);
        return;
    };

    customers.forEach(cust => {
        const initials = cust.name.split(" ").map(n => n[0]).join("").substring(0, 2).toUpperCase();

        const li = document.createElement("li");
        li.className = "list-group-item d-flex align-items-center justify-content-between";

        // Left side (avatar + name)
        const left = document.createElement("div");
        left.className = "d-flex align-items-center";

        const avatar = document.createElement("div");
        avatar.textContent = initials;
        avatar.style.backgroundColor = getRandomLightColor();
        avatar.style.width = "40px";
        avatar.style.height = "40px";
        avatar.style.borderRadius = "50%";
        avatar.style.display = "flex";
        avatar.style.alignItems = "center";
        avatar.style.justifyContent = "center";
        avatar.style.fontWeight = "bold";
        avatar.style.marginRight = "10px";

        const name = document.createElement("span");
        name.textContent = cust.name;

        left.appendChild(avatar);
        left.appendChild(name);

        // Right side (amount)
        const amount = document.createElement("span");
        amount.textContent = "₱ " + cust.amount.toLocaleString();
        amount.style.fontWeight = "semibold";

        // Add both sides
        li.appendChild(left);
        li.appendChild(amount);
        list.appendChild(li);
    });
}