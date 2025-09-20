<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/customize.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./assets/img/fishLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css">

    <!-- Utils -->
    <script defer src="./assets/js/sweetAlert.js"></script>
    <script defer src="./assets/js/chart.js"></script>
    <script defer src="./assets/js/header.js"></script>
    <script defer src="./assets/bootstrap/bootstrap.min.js"></script>
    <!-- Dashboard -->
    <script defer src="./assets/js/dashboard/topCustomer.js"></script>
    <script defer src="./assets/js/dashboard/topSellingFish.js"></script>
    <script defer src="./assets/js/dashboard/profitChart.js"></script>

    <!-- Sales -->
    <script defer src="./assets/js/sales/sales.js"></script>

    <!-- Manage Fish -->
    <script defer src="./assets/js/manageFish/fish.js"></script>

    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

    <!-- Manage Fish -->
    <script defer src="./backend/manageFish/js/crud.js"></script>

    <!-- Account -->
    <script defer src="./backend/account/js/updatePassword.js"></script>
    <script defer src="./backend/account/js/updateUsername.js"></script>

    <title>FishTracker</title>
</head>

<body>
    <!-- Header -->
    <?php include 'components/header.php'; ?>
    <div class="container py-3">
        <!-- Pages -->
        <div class="pages">
            <div class="page page-dashboard"><?php include 'pages/dashboard.php'; ?></div>
            <div class="page page-sales-entry"><?php include 'pages/sales.php'; ?></div>
            <div class="page page-manage-fish"><?php include 'pages/manageFish.php'; ?></div>
            <div class="page page-account"><?php include 'pages/account.php'; ?></div>
        </div>
    </div>
</body>

</html>