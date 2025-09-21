var salesTable = new DataTable('#tableSales', {
    columns: [
        { title: 'SaleID' },
        { title: 'Date' },
        { title: 'Customer' },
        { title: 'Total' },
        { title: 'Tendered' },
        { title: 'Change' },
        { title: 'Actions', orderable: false }
    ],
    data: [],
    order: [[1, 'desc']] // 👈 sort by first column (SaleID) in DESC order
});

// ✅ get userID from localStorage
let user = JSON.parse(localStorage.getItem("user"));
let userID = user.userID;

// Load sales
async function loadSales() {
    let formData = new FormData();
    formData.append("action", "read");
    formData.append("userID", userID); // ✅ send it in request body

    let res = await fetch("backend/sales/php/crudSales.php?", {
        method: "POST",
        body: formData
    });
    let data = await res.json();

    salesTable.clear();
    data.forEach(sale => {
        salesTable.row.add([
            "SALE-" + String(sale.id).padStart(3, "0"),
            sale.salesDate,
            sale.cusName,
            sale.grandTotal,
            sale.payAmount,
            sale.changeAmount,
            actionSalesButtons(sale.id)
        ]);
    });
    salesTable.draw();
}

// Action buttons
function actionSalesButtons(id) {
    return `
    <div class="d-flex gap-2">
        <button class="btn btn-sm btn-secondary" onclick="showOrder('${id}')">View</button>
        <button class="btn btn-sm btn-orange" onclick="editSale('${id}')">Edit</button>
        <button class="btn btn-sm btn-danger" onclick="deleteSale('${id}')">Delete</button>
    </div>
    `;
}

document.querySelector('.addNewSales').addEventListener('click', () => {
    document.getElementById('addSalesLabel').textContent = "Add Sale";
    document.getElementById("saleId").value = "";
    document.getElementById("salesDate").value = "";
    document.getElementById("cusName").value = "";
    document.getElementById("grandTotal").value = "";
    document.getElementById("payAmount").value = "";
    document.getElementById("change").value = "";
})

async function showOrder(saleId) {
    try {
        // Fetch order details from backend
        const response = await fetch(`backend/sales/php/getOrder.php?action=getOrder&id=${saleId}`);
        const data = await response.json();

        if (!data || data.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'No Orders',
                text: 'This sale has no order details.',
                confirmButtonColor: '#FA8A5F',
            });
            return;
        }

        const tbody = document.getElementById("orderDetailsBody");
        tbody.innerHTML = "";
        let grandTotal = 0;

        data.forEach(item => {
            const lineTotal = item.qty * item.price;
            grandTotal += lineTotal;

            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.fishName}</td>
                <td>${item.qty}</td>
                <td>${item.pcs}</td>
                <td>${item.price.toFixed(2)}</td>
                <td>${lineTotal.toFixed(2)}</td>
            `;
            tbody.appendChild(row);
        });

        document.getElementById("orderGrandTotal").textContent = grandTotal.toFixed(2);

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('showOrderModal'));
        modal.show();

    } catch (error) {
        console.error("Error fetching order details:", error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to load order details.',
            confirmButtonColor: '#FA8A5F',
        });
    }
}

async function editSale(id) {
    try {
        // Fetch sale details
        const response = await fetch(`backend/sales/php/getOrder.php?action=getSale&id=${id}`);
        let sale = await response.json();

        // Fetch order/cart details
        const response1 = await fetch(`backend/sales/php/getOrder.php?action=getOrder&id=${id}`);
        let data = await response1.json();

        // ✅ Ensure it's an object not an array
        if (Array.isArray(sale)) {
            sale = sale[0];
        }

        if (!sale) {
            Swal.fire({
                icon: 'error',
                title: 'Not Found',
                text: 'Sale record not found.',
                confirmButtonColor: '#FA8A5F',
            });
            return;
        }

        // ✅ Populate the form fields
        document.getElementById("addSalesLabel").textContent = "Update Sale";
        document.getElementById("saleId").value = sale.id;
        document.getElementById("salesDate").value = sale.salesDate;
        document.getElementById("cusName").value = sale.cusName;
        document.getElementById("grandTotal").value = sale.grandTotal;
        document.getElementById("payAmount").value = sale.payAmount;
        document.getElementById("change").value = sale.changeAmount;

        // ✅ Load order/cart items
        if (Array.isArray(data) && data.length > 0) {
            cartItems = data.map(item => ({
                fishId: item.fishId,
                fishName: item.fishName,
                qty: item.qty,
                pcs: item.pcs,
                price: item.price
            }));
            renderCart();
        }

        // ✅ Show the modal
        const modal = new bootstrap.Modal(document.getElementById('addSales'));
        modal.show();

    } catch (error) {
        console.error("Error fetching sale:", error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to load sale details.',
            confirmButtonColor: '#FA8A5F',
        });
    }
}

// Save Sale
document.querySelector("#addSales form").addEventListener("submit", async function (e) {
    e.preventDefault();

    // let user = JSON.parse(localStorage.getItem("user"));
    let saleId = document.getElementById("saleId").value;
    let salesDate = document.getElementById("salesDate").value;
    let cusName = toCapitalize(document.getElementById("cusName").value)
    let grandTotal = document.getElementById("grandTotal").value;
    let payAmount = document.getElementById("payAmount").value;
    let changeAmount = document.getElementById("change").value;

    let formData = new FormData();
    // formData.append("userID", user.userID);
    formData.append("userID", userID); // ✅ send it in request body
    formData.append("salesDate", salesDate);
    formData.append("cusName", cusName);
    formData.append("grandTotal", grandTotal);
    formData.append("payAmount", payAmount);
    formData.append("changeAmount", changeAmount);
    formData.append("cart", JSON.stringify(cartItems));

    if (!saleId) {
        formData.append("action", "create");
    } else {
        formData.append("action", "update");
        formData.append("id", saleId);
    }

    let res = await fetch("backend/sales/php/crudSales.php", { method: "POST", body: formData });
    let text = await res.text();

    if (text === "success") {
        await loadSales();
        this.reset();
        cartItems = [];
        renderCart();
        document.getElementById("saleId").value = "";
        bootstrap.Modal.getInstance(document.getElementById("addSales")).hide();
    } else {
        alert("Error: " + text);
    }
});

// Delete Sale
async function deleteSale(id) {
    Swal.fire({
        title: 'Are you sure you want to delete this sale?',
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

            let res = await fetch("backend/sales/php/crudSales.php", { method: "POST", body: formData });
            let text = await res.text();

            if (text === "success") {
                await loadSales();
            } else {
                alert("Error deleting: " + text);
            }
        }
    });

}

document.addEventListener("DOMContentLoaded", loadSales);
