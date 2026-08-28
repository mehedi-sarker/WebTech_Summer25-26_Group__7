<!DOCTYPE html>

<html>

<head>

    <title>Manage Products</title>

    <link rel="stylesheet" href="View/Design/design.css">

</head>

<body>

<?php include __DIR__ . "/../layout/header.php"; ?>


<div class="admin-container">

    <h2><?php echo $editProduct ? "Update Product" : "Add New Product"; ?></h2>


    <!--============ ADD / UPDATE FORM ============-->

    <form method="POST" action="index.php?page=admin-products" class="admin-form">

<?php if ($editProduct): ?>

        <input type="hidden" name="ProductID" value="<?php echo $editProduct['ProductID']; ?>">

<?php endif; ?>

        <label>Product Name</label>
        <br>
        <input type="text" name="ProductName" value="<?php echo $editProduct ? htmlspecialchars($editProduct['ProductName']) : ''; ?>" required>
        <br><br>

        <label>Club</label>
        <br>
        <input type="text" name="Club" value="<?php echo $editProduct ? htmlspecialchars($editProduct['Club']) : ''; ?>" required>
        <br><br>

        <label>Edition</label>
        <br>
        <input type="text" name="Edition" value="<?php echo $editProduct ? htmlspecialchars($editProduct['Edition']) : ''; ?>" required>
        <br><br>

        <label>Category</label>
        <br>
        <input type="text" name="Category" value="<?php echo $editProduct ? htmlspecialchars($editProduct['Category']) : ''; ?>">
        <br><br>

        <label>Price (Tk)</label>
        <br>
        <input type="number" name="Price" value="<?php echo $editProduct ? $editProduct['Price'] : ''; ?>" required>
        <br><br>

        <label>Stock</label>
        <br>
        <input type="number" name="Stock" value="<?php echo $editProduct ? $editProduct['Stock'] : ''; ?>" required>
        <br><br>

        <label>Image URL</label>
        <br>
        <input type="text" name="Image" value="<?php echo $editProduct ? htmlspecialchars($editProduct['Image']) : ''; ?>">
        <br><br>

<?php if ($editProduct): ?>

        <input type="submit" name="updateproduct" value="Update Product" class="add-cart-btn">
        <a href="index.php?page=admin-products" class="cancel-link">Cancel</a>

<?php else: ?>

        <input type="submit" name="addproduct" value="Add Product" class="add-cart-btn">

<?php endif; ?>

    </form>


    <!--============ PRODUCT LIST ============-->

    <h2>All Products</h2>

    <table class="admin-table">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Club</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>

<?php while ($row = $products->fetch_assoc()): ?>

        <tr>
            <td><?php echo $row['ProductID']; ?></td>
            <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
            <td><?php echo htmlspecialchars($row['Club']); ?></td>
            <td><?php echo $row['Price']; ?> Tk</td>
            <td><?php echo $row['Stock']; ?></td>
            <td>
                <a href="index.php?page=admin-products&edit=<?php echo $row['ProductID']; ?>">Edit</a>
                |
                <a href="index.php?page=admin-products&delete=<?php echo $row['ProductID']; ?>"
                   onclick="return confirm('Delete this product?');">Delete</a>
            </td>
        </tr>

<?php endwhile; ?>

    </table>

</div>


<?php include __DIR__ . "/../layout/footer.php"; ?>

</body>

</html>
