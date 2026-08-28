<?php
// Manage Order Dashboard
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Orders</title>

    <link rel="stylesheet" href="manageorder.css">
</head>

<body>

    <div class="order-container">

        <!-- Page Header -->
        <div class="page-header">

            <div>
                <h1>Manage Orders</h1>
                <p>Select an available product and place an order</p>
            </div>

            <a href="admin.php" class="back-btn">
                ← Admin Dashboard
            </a>

        </div>


        <!-- Available Products -->
        <div class="products-card">

            <div class="section-header">
                <h2>Available Products</h2>

                <form action="../../Controller/AdminController.php" method="GET" class="search-form">

                    <input
                        type="text"
                        name="order_search"
                        placeholder="Search product..."
                    >

                    <button type="submit">
                        Search
                    </button>

                </form>
            </div>


            <div class="product-grid">

                <!--
                    Product data will be loaded dynamically
                    from AdminController.php
                -->

                <div class="product-card">

                    <div class="product-image">
                        <span>Product Image</span>
                    </div>

                    <div class="product-info">

                        <h3>Product Name</h3>

                        <p>
                            <strong>Club:</strong>
                            Club Name
                        </p>

                        <p>
                            <strong>Edition:</strong>
                            Edition Name
                        </p>

                        <p class="product-price">
                            Price: ৳0.00
                        </p>

                        <p class="stock">
                            Available Stock: 0
                        </p>

                    </div>


                    <form
                        action="../../Controller/AdminController.php"
                        method="POST"
                        class="order-form"
                    >

                        <input
                            type="hidden"
                            name="product_id"
                            value=""
                        >

                        <label for="quantity">
                            Quantity
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            min="1"
                            value="1"
                            required
                        >

                        <button
                            type="submit"
                            name="place_order"
                            class="order-btn"
                        >
                            Order Now
                        </button>

                    </form>

                </div>


                <!-- No Product Message -->

                <!--
                <div class="no-products">
                    <p>No products are currently available.</p>
                </div>
                -->

            </div>

        </div>


        <!-- Order Summary -->

        <div class="order-summary-card">

            <h2>Order Information</h2>

            <div class="summary-grid">

                <div class="summary-item">
                    <span>Total Products</span>
                    <strong>0</strong>
                </div>

                <div class="summary-item">
                    <span>Available Products</span>
                    <strong>0</strong>
                </div>

                <div class="summary-item">
                    <span>Orders Placed</span>
                    <strong>0</strong>
                </div>

            </div>

        </div>

    </div>

</body>

</html>