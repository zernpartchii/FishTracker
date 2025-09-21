function loadTopFish(year) {
    fetch("./backend/dashboard/php/topSelling.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `action=top_fish&year=${year}`
    })
        .then(res => res.json())
        .then(fishes => {
            fetchTopSelling(fishes); // Now dynamic
        });
}

function fetchTopSelling(fishes) {
    const fishList = document.getElementById("fishList");
    fishList.innerHTML = "";

    if (fishes.length === 0) {
        const li = document.createElement("li");
        li.className = "list-group-item d-flex align-items-center justify-content-between";
        li.textContent = "No Available data for this year.";
        fishList.appendChild(li);
        return;
    }

    fishes.forEach(fish => {
        const initials = fish.name.split(" ").map(n => n[0]).join("").substring(0, 1).toUpperCase();

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
        times.textContent = fish.timesBought + (fish.timesBought > 1 ? " times bought" : " time bought");
        times.style.fontWeight = "semibold";

        // Add both sides
        li.appendChild(left);
        li.appendChild(times);
        fishList.appendChild(li);
    });
}