<!DOCTYPE html>

<html>

<head>

    <title>Login / Sign Up - Golazo Kits BD</title>

    <link rel="stylesheet" href="View/Design/design.css">
    <script src="JS/usernameExists.js"></script>
<script>

function validateLogin()
{
    let name = document.getElementsByName("name")[0].value.trim();
    let password = document.getElementsByName("password")[0].value.trim();

    let valid = true;
    let message = "";

    if(name.length < 5)
    {
        message += "User Name Should be 5 Char\n";
        valid = false;
    }

    if(password.length < 5)
    {
        message += "Password Must be 5 Char";
        valid = false;
    }

    if(!valid)
    {
        alert(message);
    }

    return valid;
}


function validateSignup()
{
    let name = document.getElementById("name").value.trim();

    let password = document.getElementsByName("password")[0].value.trim();

    let confirm_password = document.getElementsByName("confirm_password")[0].value.trim();

    let valid = true;
    let message = "";

    if(name.length < 5)
    {
        message += "User Name Should be 5 Char\n";
        valid = false;
    }

    if(password.length < 5)
    {
        message += "Password Must be 5 Char\n";
        valid = false;
    }

    if(confirm_password.length < 5)
    {
        message += "Confirm Password Must be 5 Char\n";
        valid = false;
    }

    if(password != confirm_password)
    {
        message += "Password and Confirm Password Must be Same";
        valid = false;
    }

    if(!valid)
    {
        alert(message);
    }

    return valid;
}

</script>
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

        <form method="POST" action="index.php?page=login" onsubmit="return validateLogin();">

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

        <form method="POST" action="index.php?page=signup" onsubmit="return validateSignup()">

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