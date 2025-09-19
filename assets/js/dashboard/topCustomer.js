const customers = [{
    name: "Juan Dela Cruz",
    amount: 25400
},
{
    name: "Maria Santos",
    amount: 19800
},
{
    name: "Pedro Ramirez",
    amount: 17250
},
{
    name: "Ana Lopez",
    amount: 15000
},
{
    name: "Carlos Mendoza",
    amount: 13200
},
{
    name: "Sophia Reyes",
    amount: 12100
},
{
    name: "Miguel Torres",
    amount: 11050
},
{
    name: "Isabella Flores",
    amount: 9800
},
{
    name: "Jose Villanueva",
    amount: 8700
},
{
    name: "Andrea Bautista",
    amount: 7650
}
];

// Function to generate random light color
function getRandomLightColor() {
    const r = Math.floor(Math.random() * 128 + 127);
    const g = Math.floor(Math.random() * 128 + 127);
    const b = Math.floor(Math.random() * 128 + 127);
    return `rgb(${r}, ${g}, ${b})`;
}

const list = document.getElementById("customerList");

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