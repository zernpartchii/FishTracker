<div class="modal fade" id="addSales" aria-hidden="true" aria-labelledby="addSalesLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addSalesLabel">New Sales</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="saleId"> <!-- for update -->
                <div class="form-group">
                    <input type="date" id="salesDate" class="form-control-custom" placeholder="" required>
                    <label for="salesDate" class="form-label-custom">Date</label>
                </div>

                <div class="form-group">
                    <input type="search" id="cusName" class="form-control-custom" placeholder="">
                    <label for="cusName" class="form-label-custom">Customer Name (Optional)</label>
                </div>

                <div class="form-group" id="fishGroup">
                    <select id="fishSelect" class="form-control-custom">
                        <option value="" disabled selected>Select Fish</option>
                        <!-- Options will be populated dynamically -->
                    </select>
                    <label for="fishSelect" class="form-label-custom">Fish Name</label>
                </div>

                <div class="flex-between mb-3">
                    <button type="button" id="add" class="btn btn-sm btn-orange rounded-5 bi-plus">
                        Add Fish
                    </button>
                    <button type="button" id="btnAddFish" class="btn btn-sm btn-secondary rounded-5 bi-arrow-right"
                        data-bs-toggle="modal" data-bs-target="#addFishModal">
                        Add New Fish
                    </button>
                </div>

                <!-- Table to display cart items -->
                <div class="table-responsive">
                    <table class="table" id="cartTable">
                        <thead>
                            <tr>
                                <th>Fish</th>
                                <th>Qty</th>
                                <th>Pcs</th>
                                <th>Price</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart items will be appended here -->
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <input type="text" id="grandTotal" class="form-control-custom" placeholder="" readonly>
                    <label for="grandTotal" class="form-label-custom">Grand Total</label>
                </div>

                <div class="form-group">
                    <input type="number" id="payAmount" class="form-control-custom" placeholder="">
                    <label for="payAmount" class="form-label-custom">Tendered</label>
                </div>

                <div class="form-group">
                    <input type="text" id="change" class="form-control-custom" placeholder="" readonly>
                    <label for="change" class="form-label-custom">Change</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-orange disabled addSales">Save Sales</button>
            </div>
        </form>
    </div>
</div>