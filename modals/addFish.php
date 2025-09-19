<div class="modal fade" id="addFish" aria-hidden="true" aria-labelledby="addFishLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addFishLabel">Add Fish</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="date" id="salesDate" class="form-control-custom" placeholder="" required>
                    <label for="salesDate" class="form-label-custom">Date</label>
                </div>
                <div class="form-group" id="addFish">
                    <input type="search" id="addFish" class="form-control-custom" required placeholder="">
                    <label for="addFish" class="form-label-custom">Fish Name</label>
                </div>
                <div class="form-group" id="addfishType">
                    <input type="search" id="addFish" class="form-control-custom" required placeholder="">
                    <label for="addFish" class="form-label-custom">Fish Type</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-orange" data-bs-dismiss="modal"
                    aria-label="Close">Cancel</button>
                <button type="submit" class="btn btn-orange">Add Fish</button>
            </div>
        </form>
    </div>
</div>