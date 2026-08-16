<!DOCTYPE html>

<html>

<head>

    <title>Login - Golazo Kits BD</title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php include __DIR__ . "/../Layout/header.php"; ?>


<div class="auth-container">

    <h2>Login</h2>

<?php if ($error): ?>

    <p class="auth-error"><?php echo htmlspecialchars($error); ?></p>

<?php endif; ?>

    <form action="index.php?page=login" method="POST">

        <label>Login As</label>
        <br>
        <select name="role" required>
            <option value="customer">Customer</option>
            <option value="admin">Admin</option>
            <option value="deliveryman">Delivery Man</option>
        </select>
        <br><br>

        <label>Username / ID</label>
        <br>
        <input type="text" name="userid" required>
        <br><br>

        <label>Password</label>
        <br>
        <input type="password" name="password" required>
        <br><br>

        <input type="submit" name="login" value="Login" class="add-cart-btn">

    </form>

    <p class="auth-switch">
        New customer?
        <a href="index.php?page=signup">Create an account</a>
    </p>

</div>


<?php include __DIR__ . "/../Layout/footer.php"; ?>


</body>

</html>
