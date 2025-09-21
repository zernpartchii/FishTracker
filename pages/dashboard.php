<h2>Dashboard</h2>
<div class="row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <div class="card border-0 profit mb-3 p-1" style="height: 20rem;">
            <div class="card-body">
                <div class="flex-between">
                    <p class="card-text m-0 mb-2">Total Profit Amount in <span id="profitYear">0000</span></p>
                    <select class="form-select form-select-sm" id="yearSelect" style="width: 5rem;">
                        <!-- Options will be populated dynamically -->
                    </select>
                </div>
                <!-- 🔥 This will be updated dynamically -->
                <h1 class="card-title fw-semibold" id="totalSales">₱ 0</h1>
                <p class="card-text text-light">
                    <span class="badge bg-warning text-success rounded-pill" id="profitGrowth">+0%</span>
                </p>
            </div>
            <!-- 🔥 Chart container with fixed height -->
            <div class="chart-container" style="position: relative; height:100%; width:100%;">
                <canvas id="chartProfit"></canvas>
            </div>
        </div>

        <div class="row">
            <!-- Total Sold -->
            <div class="col-sm-6 mb-3">
                <div class="card border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="cardContainer flex-center me-3">
                            <i class="bi bi-cart-check-fill fs-1 iconColor"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Sold</h6>
                            <h2 class="fw-semibold mb-0" id="totalSold">0</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fish Categories -->
            <div class="col-sm-6 mb-3">
                <div class="card border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="cardContainer flex-center me-3">
                            <i class="bi bi-grid-fill fs-1 iconColor"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Fish Category</h6>
                            <h2 class="fw-semibold mb-0" id="fishCount">0</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-body">
                <h6 class="card-title mb-3">Top 5 Best Selling Fish</h6>
                <ul class="list-group list-group-flush" id="fishList"></ul>
            </div>
        </div>
    </div>

    <div class="col-sm-6 mb-sm-0">
        <div class="card border-0 h-100">
            <div class="card-body">
                <h6 class="card-title mb-3">Top 10 Customers</h6>
                <ul class="list-group list-group-flush" id="customerList"></ul>
            </div>
        </div>
    </div>
</div>