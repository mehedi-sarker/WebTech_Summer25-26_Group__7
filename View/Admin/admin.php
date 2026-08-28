<?php
// Admin Dashboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="admin.css">
</head>

<body>

    <div class="admin-container">

        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <p>Manage your products and orders</p>
        </div>


        <div class="admin-options">

            <!-- Manage Product -->
            <a href="manageproduct.php" class="admin-card">

                <div class="card-icon">
                    📦
                </div>

                <div class="card-content">
                    <h2>Manage Product</h2>
                    <p>
                        Add, update, delete and search products.
                    </p>
                </div>

                <div class="card-arrow">
                    →
                </div>

            </a>


            <!-- Manage Order -->
            <a href="manageorder.php" class="admin-card">

                <div class="card-icon">
                    🛒
                </div>

                <div class="card-content">
                    <h2>Manage Order</h2>
                    <p>
                        View available products and place orders.
                    </p>
                </div>

                <div class="card-arrow">
                    →
                </div>

            </a>

        </div>

    </div>

</body>
</html>