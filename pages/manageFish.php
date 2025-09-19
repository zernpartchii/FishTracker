<div class="d-flex align-items-center gap-3 mb-3">
    <h2>Manage Fish</h2>
    <button type="button" class="btn btn-orange bi-plus rounded-5" data-bs-toggle="modal" data-bs-target="#addFish">
        Add Fish
    </button>
</div>
<div class="card border-0 table-responsive p-3">
    <table id="tableFish" class="display" width="100%"></table>
</div>


<?php include './modals/addFish.php'; ?>