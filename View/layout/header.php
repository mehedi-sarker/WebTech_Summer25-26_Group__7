<header>

    <h1>Golazo Kits BD</h1>

    <nav>

        <a href="index.php">Home</a>

        <a href="index.php?page=products">Products</a>

        <a href="index.php?page=about">About Us</a>

        <a href="index.php?page=cart">Cart</a>

<?php if (isset($_SESSION['user_type'])): ?>

        <a href="<?php echo ($_SESSION['user_type'] == 'admin') ? 'index.php?page=admin-dashboard' : (($_SESSION['user_type'] == 'deliveryman') ? 'index.php?page=delivery-dashboard' : '#'); ?>">
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </a>

        <a href="index.php?page=logout">Logout</a>

<?php else: ?>

        <a href="index.php?page=login">Login</a>

<?php endif; ?>

        <form action="index.php" method="GET" class="search-box">

            <input type="hidden" name="page" value="products">

            <input type="text"
                   name="search"
                   placeholder="Search Jersey">

            <input type="submit"
                   value="Search">

        </form>

    </nav>

</header>
