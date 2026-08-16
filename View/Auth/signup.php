<!DOCTYPE html>

<html>

<head>

    <title>Sign Up - Golazo Kits BD</title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php include __DIR__ . "/../Layout/header.php"; ?>


<div class="auth-container">

    <h2>Create an Account</h2>

<?php if ($error): ?>

    <p class="auth-error"><?php echo htmlspecialchars($error); ?></p>

<?php endif; ?>

    <form action="index.php?page=signup" method="POST">

        <label>Username</label>
        <br>
        <input type="text" name="username" required>
        <br><br>

        <label>Password</label>
        <br>
        <input type="password" name="password" required>
        <br><br>

        <label>Confirm Password</label>
        <br>
        <input type="password" name="confirm_password" required>
        <br><br>

        <input type="submit" name="signup" value="Sign Up" class="add-cart-btn">

    </form>

    <p class="auth-switch">
        Already have an account?
        <a href="index.php?page=login">Login</a>
    </p>

</div>


<?php include __DIR__ . "/../Layout/footer.php"; ?>


</body>

</html>
