
/* Calculate change */
document.querySelector('#payAmount').addEventListener('input', function () {
    const grandTotal = document.getElementById('grandTotal').value;
    const change = this.value - grandTotal;
    document.getElementById('change').value = change.toFixed(2);

    if (change >= 0) {
        document.querySelector('.addSales').classList.remove('disabled');
    } else {
        document.querySelector('.addSales').classList.add('disabled');
    }
})

const cartTableBody = document.querySelector('#cartTable tbody');
let cartItems = [];

// Add to Cart
document.getElementById('add').addEventListener('click', function () {
    const fishSelect = document.getElementById('fishSelect');
    const fishId = fishSelect.value;
    const fishName = fishSelect.options[fishSelect.selectedIndex].text;

    if (!fishId) {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Please select a fish.',
            confirmButtonColor: '#FA8A5F',
        });
        return;
    }

    const bundlePrice = parseFloat(fishSelect.options[fishSelect.selectedIndex].dataset.price) || 0;

    // Check if fish already in cart
    const existingIndex = cartItems.findIndex(item => item.fishId === fishId);
    if (existingIndex >= 0) {
        cartItems[existingIndex].qty += 1; // increase quantity
    } else {
        cartItems.push({
            fishId,
            fishName,
            qty: 1,
            pcs: 1,
            price: bundlePrice // set initial price
        });
    }

    renderCart();
});

// Render Cart
function renderCart() {
    cartTableBody.innerHTML = '';
    let grandTotal = 0;

    cartItems.forEach((item, index) => {
        const lineTotal = item.qty * item.price;
        grandTotal += lineTotal;

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-truncate">${item.fishName}</td>
            <td><input type="number" min="1" value="${item.qty}" data-index="${index}" class="form-control form-control-sm edit-qty" style="width:60px;"></td>
            <td><input type="number" min="1" value="${item.pcs}" data-index="${index}" class="form-control form-control-sm edit-pcs" style="width:60px;"></td>
            <td><input type="number" min="0" value="${item.price}" data-index="${index}" class="form-control form-control-sm edit-price" style="width:60px;"></td>
            <td><button type="button" class="btn btn-sm btn-danger btn-delete bi-trash" data-index="${index}"></button></td>
        `;
        cartTableBody.appendChild(row);
    });

    document.getElementById('grandTotal').value = grandTotal.toFixed(2);

    // Add event listeners for qty change
    document.querySelectorAll('.edit-qty').forEach(input => {
        input.addEventListener('input', function () {
            const idx = this.dataset.index;
            cartItems[idx].qty = parseInt(this.value) || 1;
            updateTotals();
        });
    });

    // Add event listeners for price change
    document.querySelectorAll('.edit-price').forEach(input => {
        input.addEventListener('input', function () {
            const idx = this.dataset.index;
            cartItems[idx].price = parseFloat(this.value) || 0;
            updateTotals();
        });
    });

    // Delete button
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            const idx = this.dataset.index;
            cartItems.splice(idx, 1);
            renderCart();
        });
    });
}

// Update line totals and grand total without wiping input values
function updateTotals() {
    let grandTotal = 0;
    cartItems.forEach((item, index) => {
        const lineTotal = item.qty * item.price;
        grandTotal += lineTotal;
    });
    document.getElementById('grandTotal').value = grandTotal.toFixed(2);
}