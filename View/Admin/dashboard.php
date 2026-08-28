<!DOCTYPE html>

<html>

<head>

    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="View/Design/design.css">

</head>

<body>

<?php include __DIR__ . "/../layout/header.php"; ?>


<div class="admin-container">

    <h2>Admin Dashboard</h2>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>

    <div class="admin-menu">

        <a href="index.php?page=admin-products" class="admin-menu-card">
            <h3>Manage Products</h3>
            <p>Add, update stock/details, or remove products.</p>
        </a>

        <a href="index.php?page=admin-orders" class="admin-menu-card">
            <h3>Manage Orders</h3>
            <p>View customer orders and billing details.</p>
        </a>

    </div>

</div>


<?php include __DIR__ . "/../layout/footer.php"; ?>

</body>

</html>
