<div class="d-flex align-items-center gap-3 mb-3">
    <h2>Sales Entry</h2>
    <button type="button" class="btn btn-orange bi-plus addNewSales rounded-5" data-bs-toggle="modal"
        data-bs-target="#addSales">
        New Sales
    </button>
</div>

<!-- <div class="row">
    <div class="col-md-4 mb-3 d-none">
        <div class="card h-100 p-3 border-0 shadow-sm">
            <h6 class="mb-1">Weekly Sales</h6>
            <h2 id="weeklyTotal" class="fw-semibold text-orange">₱0</h2>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card h-100 p-3 border-0 shadow-sm">
            <div class="flex-between">
                <h6 class="mb-1">Monthly Sales</h6>
                <select id="monthFilter" class="form-select form-select-sm" style="width: 5rem;">
                    <option value="all">All</option>
                    <option value="01">Jan</option>
                    <option value="02">Feb</option>
                    <option value="03">Mar</option>
                    <option value="04">Apr</option>
                    <option value="05">May</option>
                    <option value="06">Jun</option>
                    <option value="07">Jul</option>
                    <option value="08">Aug</option>
                    <option value="09">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
            </div>
            <h2 id="monthlyTotal" class="fw-semibold text-orange">₱0</h2>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card h-100 p-3 border-0 shadow-sm">
            <div class="flex-between">
                <h6 class="mb-1">Yearly Sales</h6>
                <select id="yearFilter" class="form-select form-select-sm" style="width: 5rem;"></select>
            </div>
            <h2 id="yearlyTotal" class="fw-semibold text-orange">₱0</h2>
        </div>
    </div>
</div> -->

<div class="card border-0 table-responsive p-3">
    <table id="tableSales" class="display" width="100%"></table>
</div>