<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/customize.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/img/fishLogo.png" type="image/x-icon">

    <!-- Utils -->
    <script defer src="../assets/js/sweetAlert.js"></script>
    <script defer src="../assets/js/chart.js"></script>
    <script defer src="../assets/js/header.js"></script>
    <script defer src="../assets/bootstrap/bootstrap.min.js"></script>

    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

    <!-- Dashboard -->
    <script defer src="../backend/dashboard/js/dashboardChart.js"></script>
    <script defer src="../backend/dashboard/js/topCustomer.js"></script>
    <script defer src="../backend/dashboard/js/topSelling.js"></script>

    <!-- Sales -->
    <script defer src="../backend/sales/js/crudSales.js"></script>
    <script defer src="../backend/sales/js/orderItems.js"></script>

    <!-- Manage Fish -->
    <script defer src="../backend/manageFish/js/crud.js"></script>
    <script defer src="../backend/manageFish/js/fishList.js"></script>

    <!-- Account -->
    <script defer src="../backend/account/js/updatePassword.js"></script>
    <script defer src="../backend/account/js/updateUsername.js"></script>

    <title>FishTracker</title>
</head>

<body>
    <!-- Header -->
    <?php include '../components/header.php'; ?>
    <div class="container py-3 main">
        <!-- Pages -->
        <div class="pages">
            <div class="page page-dashboard"><?php include './dashboard.php'; ?></div>
            <div class="page page-sales-entry"><?php include './sales.php'; ?></div>
            <div class="page page-manage-fish"><?php include './manageFish.php'; ?></div>
            <div class="page page-account"><?php include './account.php'; ?></div>
        </div>
    </div>

    <?php include '../components/footer.php'; ?>

    <?php include '../modals/addFish.php'; ?>
    <?php include '../modals/addSales.php'; ?>
    <?php include '../modals/showOrder.php'; ?>
</body>

</html>