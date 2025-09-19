const fishes = [
    { name: "Fighting Fish", times: 120 },
    { name: "Molly", times: 95 },
    { name: "Goldfish", times: 88 },
    { name: "Guppy", times: 74 },
    { name: "Angelfish", times: 65 }
];

// Function to generate random light color
function getRandomLightColor() {
    const r = Math.floor(Math.random() * 128 + 127);
    const g = Math.floor(Math.random() * 128 + 127);
    const b = Math.floor(Math.random() * 128 + 127);
    return `rgb(${r}, ${g}, ${b})`;
}

const fishList = document.getElementById("fishList");

fishes.forEach(fish => {
    const initials = fish.name.split(" ").map(n => n[0]).join("").substring(0, 2).toUpperCase();

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
    name.textContent = fish.name;

    left.appendChild(avatar);
    left.appendChild(name);

    // Right side (buy times)
    const times = document.createElement("span");
    times.textContent = fish.times + (fish.times > 1 ? " times bought" : " time bought");
    times.style.fontWeight = "semibold";

    // Add both sides
    li.appendChild(left);
    li.appendChild(times);
    fishList.appendChild(li);
});