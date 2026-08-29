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

        <button
            type="button"
            class="tab-btn <?php echo ($activeTab == 'login') ? 'active' : ''; ?>"
            onclick="showTab('login')"
        >
            Login
        </button>

        <button
            type="button"
            class="tab-btn <?php echo ($activeTab == 'signup') ? 'active' : ''; ?>"
            onclick="showTab('signup')"
        >
            Sign Up
        </button>

    </div>


<?php if (!empty($message)): ?>

    <p class="auth-error"><?php echo htmlspecialchars($message); ?></p>

<?php endif; ?>


    <!--============ LOGIN FORM ============-->

    <div id="loginForm" class="auth-form <?php echo ($activeTab == 'login') ? '' : 'hidden'; ?>">

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

        </form>

    </div>


    <!--============ SIGNUP FORM ============-->

    <div id="signupForm" class="auth-form <?php echo ($activeTab == 'signup') ? '' : 'hidden'; ?>">

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


</div>


<script>

function showTab(tab)
{
    var loginForm  = document.getElementById("loginForm");
    var signupForm = document.getElementById("signupForm");

    var loginTab  = document.querySelector('.tab-btn:nth-child(1)');
    var signupTab = document.querySelector('.tab-btn:nth-child(2)');

    if (tab == "login")
    {
        loginForm.classList.remove("hidden");
        signupForm.classList.add("hidden");

        loginTab.classList.add("active");
        signupTab.classList.remove("active");
    }
    else
    {
        signupForm.classList.remove("hidden");
        loginForm.classList.add("hidden");

        signupTab.classList.add("active");
        loginTab.classList.remove("active");
    }
}

</script>


<?php include __DIR__ . "/../layout/footer.php"; ?>

</body>

</html>
