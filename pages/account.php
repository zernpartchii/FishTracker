<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-center text-muted">My Account</h3>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" disabled>
                    </div>

                    <div class="mb-3">
                        <!-- Username -->
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <input type="text" id="username" class="form-control" disabled>

                            <!-- Change Username -->
                            <button id="changeUsernameBtn" class="btn btn-orange">
                                <i class="bi bi-person-badge me-2"></i> Change
                            </button>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="d-grid">
                        <button id="newPasswordBtn" class="btn btn-orange">
                            <i class="bi bi-key me-2"></i> Change Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>