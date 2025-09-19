<div class="modal fade" id="addSales" aria-hidden="true" aria-labelledby="addSalesLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addSalesLabel">New Sales</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="date" id="salesDate" class="form-control-custom" placeholder="" required>
                    <label for="salesDate" class="form-label-custom">Date</label>
                </div>

                <div class="form-group">
                    <input type="search" id="cusName" class="form-control-custom" placeholder="" required>
                    <label for="cusName" class="form-label-custom">Customer Name</label>
                </div>

                <div class="form-group" id="fishGroup">
                    <select id="fishSelect" class="form-control-custom" required>
                        <option value="" disabled selected>Select Fish</option>
                        <option value="Betta">Fighting Fish (Betta)</option>
                        <option value="Molly">Molly</option>
                        <option value="Goldfish">Goldfish</option>
                        <option value="Guppy">Guppy</option>
                    </select>
                    <label for="fishSelect" class="form-label-custom">Fish Name</label>
                </div>

                <button type="button" id="btnAddFish" class="btn btn-sm btn-orange bi-plus rounded-5"
                    data-bs-toggle="modal" data-bs-target="#addNewFish">
                    Add New Fish
                </button>

                <div class="form-group" id="fishType">
                    <select id="fishTypeSelect" class="form-control-custom" required>
                        <option value="" disabled selected>Select Type</option>
                        <option value="Freshwater">Freshwater</option>
                        <option value="Saltwater">Saltwater</option>
                        <option value="Aquarium">Aquarium</option>
                        <option value="Marine">Marine</option>
                    </select>
                    <label for="fishSelect" class="form-label-custom">Fish Type</label>
                </div>

                <div class="d-flex gap-3">
                    <div class="form-group m-0">
                        <input type="number" id="qty" class="form-control-custom" placeholder="" required>
                        <label for="qty" class="form-label-custom">Quantity</label>
                    </div>

                    <div class="form-group m-0">
                        <input type="number" id="price" class="form-control-custom" placeholder="" required>
                        <label for="price" class="form-label-custom">Price</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-orange">Add Sales</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="addNewFish" aria-hidden="true" aria-labelledby="addNewFishLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addNewFishLabel">Add New Fish</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="date" id="dateRegister" class="form-control-custom" placeholder="" required>
                    <label for="dateRegister" class="form-label-custom">Date</label>
                </div>
                <div class="form-group" id="newFish">
                    <input type="search" id="newFish" class="form-control-custom" required placeholder="">
                    <label for="newFish" class="form-label-custom">Fish Name</label>
                </div>
                <div class="form-group" id="newfishType">
                    <input type="search" id="newFish" class="form-control-custom" required placeholder="">
                    <label for="newFish" class="form-label-custom">Fish Type</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-orange" data-bs-target="#addSales"
                    data-bs-toggle="modal">Back</button>
                <button type="submit" class="btn btn-orange">Add Fish</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('qty').addEventListener('input', function() {
    if (this.value < 0) this.value = 0;
});

document.getElementById('price').addEventListener('input', function() {
    if (this.value < 0) this.value = 0;
});
</script>