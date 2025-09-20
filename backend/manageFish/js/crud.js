// Initialize DataTable (empty at first, we’ll load from DB)
var table = new DataTable('#tableFish', {
    columns: [
        { title: 'FishID' },
        { title: 'Date Registered' },
        { title: 'Fish Name' },
        { title: 'Fish Type' },
        { title: 'Actions', orderable: false }
    ],
    data: [],
    lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
    ],
});

// ✅ Generate action buttons
function actionButtons(fishId) {
    return `
    <button class="btn btn-sm btn-warning" onclick="editFish('${fishId}')">Edit</button>
    <button class="btn btn-sm btn-danger" onclick="deleteFish('${fishId}')">Delete</button>
    `;
}

// ✅ Load fish data from DB
async function loadFish() {
    let formData = new FormData();
    formData.append("action", "read");

    let res = await fetch("backend/manageFish/php/crudFish.php", { method: "POST", body: formData });
    let data = await res.json();

    console.log("🐟 Fetched data:", data); // Debug check

    table.clear();
    data.forEach(fish => {
        table.row.add([
            "FISH-" + String(fish.id).padStart(3, "0"),
            fish.dateRegistered || "",   // ✅ use correct field name
            fish.fishName || "",         // ✅ corrected from fishNme → fishName
            fish.fishType || "",         // ✅ now works
            actionButtons(fish.id)
        ]);
    });
    table.draw();
}

document.querySelector('.addFish').addEventListener('click', () => {
    document.getElementById('addFishLabel').textContent = "Add Fish";
    document.getElementById("fishId").value = "";
    document.getElementById("dateRegistered").value = "";
    document.getElementById("fishName").value = "";
    document.getElementById("fishTypes").value = "";
})

function toCapitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// ✅ Add or Update Fish
document.getElementById("fishForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    let fishId = document.getElementById("fishId").value;
    let dateRegistered = toCapitalize(document.getElementById("dateRegistered").value)
    let fishName = toCapitalize(document.getElementById("fishName").value)
    let fishType = toCapitalize(document.getElementById("fishTypes").value)

    let formData = new FormData();
    formData.append("dateRegistered", dateRegistered); // ✅ fixed
    formData.append("fishName", fishName);
    formData.append("fishType", fishType);

    if (!fishId) {
        formData.append("action", "create");
    } else {
        formData.append("action", "update");
        formData.append("id", fishId);
    }

    let res = await fetch("backend/manageFish/php/crudFish.php", { method: "POST", body: formData });
    let text = await res.text();

    if (text === "success") {
        const action = document.getElementById('addFishLabel').textContent;
        if (action == "Add Fish") {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Fish added successfully!',
                confirmButtonColor: '#FA8A5F',
            })
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Fish updated successfully!',
                confirmButtonColor: '#FA8A5F',
            })
        }
        await loadFish();
        this.reset();
        document.getElementById("fishId").value = "";
        bootstrap.Modal.getInstance(document.getElementById("addFishModal")).hide();
    } else if (text === "exists") {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'This fish record already exists!',
            confirmButtonColor: '#FA8A5F',
        });
    } else {
        alert("Error: " + text);
    }
});

// ✅ Edit Fish
function editFish(id) {
    let rowData = table.rows().data().toArray().find(row => row[0] === "FISH-" + String(id).padStart(3, "0"));
    if (!rowData) return;

    document.getElementById('addFishLabel').textContent = "Update Fish";
    document.getElementById("fishId").value = id;
    document.getElementById("dateRegistered").value = rowData[1]; // ✅ fixed
    document.getElementById("fishName").value = rowData[2];
    document.getElementById("fishTypes").value = rowData[3];

    new bootstrap.Modal(document.getElementById("addFishModal")).show();
}

// ✅ Delete Fish
function deleteFish(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FA8A5F',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(async (result) => {
        if (result.isConfirmed) {
            let formData = new FormData();
            formData.append("action", "delete");
            formData.append("id", id);

            let res = await fetch("backend/manageFish/php/crudFish.php", { method: "POST", body: formData });
            let text = await res.text();

            if (text === "success") {
                await loadFish();
            } else {
                alert("Error deleting: " + text);
            }
        }
    });
}

// ✅ Load fish on page ready
document.addEventListener("DOMContentLoaded", loadFish);
