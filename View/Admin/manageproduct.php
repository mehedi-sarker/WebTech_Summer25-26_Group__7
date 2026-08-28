<?php
// Manage Product Dashboard
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products</title>

    <link rel="stylesheet" href="manageproduct.css">
</head>

<body>

    <div class="product-container">

        <!-- Header -->
        <div class="page-header">

            <div>
                <h1>Manage Products</h1>
                <p>Add, update, delete and search products</p>
            </div>

            <a href="admin.php" class="back-btn">
                ← Admin Dashboard
            </a>

        </div>


        <!-- Add Product Section -->
        <div class="product-form-card">

            <h2>Add New Product</h2>

            <form action="../../Controller/AdminController.php" method="POST">

                <div class="form-grid">

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="productName">Product Name</label>

                        <input
                            type="text"
                            id="productName"
                            name="productName"
                            placeholder="Enter product name"
                            required
                        >
                    </div>


                    <!-- Club -->
                    <div class="form-group">
                        <label for="club">Club</label>

                        <input
                            type="text"
                            id="club"
                            name="club"
                            placeholder="Enter club name"
                            required
                        >
                    </div>


                    <!-- Edition -->
                    <div class="form-group">
                        <label for="edition">Edition</label>

                        <input
                            type="text"
                            id="edition"
                            name="edition"
                            placeholder="Enter edition"
                            required
                        >
                    </div>


                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price</label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            placeholder="Enter price"
                            min="0"
                            step="0.01"
                            required
                        >
                    </div>


                    <!-- Stock -->
                    <div class="form-group">
                        <label for="stock">Stock</label>

                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            placeholder="Enter stock quantity"
                            min="0"
                            required
                        >
                    </div>


                    <!-- Image -->
                    <div class="form-group">
                        <label for="image">Image</label>

                        <input
                            type="text"
                            id="image"
                            name="image"
                            placeholder="Enter image path"
                        >
                    </div>

                </div>


                <button type="submit" name="add_product" class="add-btn">
                    + Add Product
                </button>

            </form>

        </div>


        <!-- Search Section -->
        <div class="search-card">

            <form action="../../Controller/AdminController.php" method="GET">

                <input
                    type="text"
                    name="search"
                    placeholder="Search product by name, club or edition..."
                >

                <button type="submit" class="search-btn">
                    Search
                </button>

            </form>

        </div>


        <!-- Product List -->
        <div class="product-list-card">

            <div class="list-header">
                <h2>Product List</h2>
            </div>


            <div class="table-container">

                <table>

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Club</th>
                            <th>Edition</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>

                    </thead>


                    <tbody>

                        <!--
                            Product data will be loaded here
                            from AdminController.php
                        -->

                        <tr>

                            <td colspan="8" class="no-data">
                                No products available.
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>