<!-- Show Order Modal -->
<div class="modal fade" id="showOrderModal" tabindex="-1" aria-labelledby="showOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showOrderLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fish</th>
                            <th>Qty</th>
                            <th>Pcs</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="orderDetailsBody">
                        <!-- Orders will be injected here -->
                    </tbody>
                </table>
                <div class="text-center text-orange fw-bold h3">
                    Grand Total: ₱<span id="orderGrandTotal">0.00</span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>