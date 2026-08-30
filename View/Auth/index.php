<!DOCTYPE html>

<html>

<head>

    <title>Login / Sign Up - Golazo Kits BD</title>

    <link rel="stylesheet" href="View/Design/design.css">
    <script src="JS/usernameExists.js"></script>

</head>

<body>

<?php include __DIR__ . "/../layout/header.php"; ?>


<div class="auth-toggle-container">

    <div class="auth-tabs">

        <a href="index.php?page=login" class="tab-btn <?php echo ($activeTab == 'login') ? 'active' : ''; ?>" style="text-decoration:none;">
            Login
        </a>

        <a href="index.php?page=signup" class="tab-btn <?php echo ($activeTab == 'signup') ? 'active' : ''; ?>" style="text-decoration:none;">
            Sign Up
        </a>

    </div>


<?php if (!empty($message)): ?>

    <p class="auth-error"><?php echo htmlspecialchars($message); ?></p>

<?php endif; ?>


    <!--============ LOGIN FORM ============-->

<?php if ($activeTab == 'login'): ?>

    <div id="loginForm" class="auth-form">

        <form method="POST" action="index.php?page=login">

            <label>Username</label>
            <br>
            <input type="text" name="name" required>
            <br><br>

            <label>Password</label>
            <br>
            <input type="password" name="password" required>
            <br><br>

            <label>
                <input type="checkbox" name="remember" value="1">
                Remember Me
            </label>
            <br><br>

            <input type="submit" name="login" value="Login" class="add-cart-btn">
            <br><br>
            <a href="index.php?page=reset-password">Forgot Password? Reset here</a>
        </form>

    </div>

<?php endif; ?>


    <!--============ SIGNUP FORM ============-->

<?php if ($activeTab == 'signup'): ?>

    <div id="signupForm" class="auth-form">

        <form method="POST" action="index.php?page=signup">

            <label>Username</label>
            <br>
            <input type="text" name="name" id="name" onkeyup="CheckUser()" required>
            <span id="userresponse"></span>
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

    </div>

<?php endif; ?>


</div>


<?php include __DIR__ . "/../layout/footer.php"; ?>

</body>

</html>