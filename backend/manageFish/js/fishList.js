// ✅ Populate fish select dynamically
async function populateFishSelect() {
    let formData = new FormData();
    formData.append("action", "read");
    formData.append("userID", userID);

    let res = await fetch("backend/manageFish/php/crudFish.php", { method: "POST", body: formData });
    let data = await res.json();

    let select = document.getElementById("fishSelect");

    // Clear previous options except the first
    select.innerHTML = '<option value="" disabled selected>Select Fish</option>';

    data.forEach(fish => {
        let option = document.createElement("option");
        option.value = fish.id; // ✅ set fish id as value
        option.text = `${fish.fishName} (${fish.fishType})`; // display name with type
        select.appendChild(option);
    });
}

// Call it on page load
document.addEventListener("DOMContentLoaded", populateFishSelect);
