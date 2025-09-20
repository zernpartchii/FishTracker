<div class="modal fade" id="addFishModal" aria-hidden="true" aria-labelledby="addFishLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="fishForm">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addFishLabel">Add Fish</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="fishId"> <!-- for update -->

                <div class="form-group">
                    <input type="date" id="dateRegistered" class="form-control-custom" required placeholder="">
                    <label for="dateRegistered" class="form-label-custom">Date</label>
                </div>
                <div class="form-group">
                    <input type="text" id="fishName" class="form-control-custom" required placeholder="">
                    <label for="fishName" class="form-label-custom">Fish Name</label>
                </div>
                <div class="form-group">
                    <input type="text" id="fishTypes" class="form-control-custom" required placeholder="">
                    <label for="fishTypes" class="form-label-custom">Fish Type</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-orange" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-orange">Save Fish</button>
            </div>
        </form>
    </div>
</div>