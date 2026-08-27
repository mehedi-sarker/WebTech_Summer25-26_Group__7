<?php
include "../../Controller/loginvalidation.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title> Login</title>
    <link rel="stylesheet" href="../Design/login.css">

    <script>
        function collect_data()
        {
            
            let password = document.getElementById("password").value.trim();
            let message = "";
            let valid = true;

            if(password.length < 1)
            {
                message += "Password is required ";
                valid = false;
            }
            else if(password.length < 8)
            {
                message += "Password must be at least 8 characters long ";
                valid = false;
            }

            if(message)
            {
                alert(message);
            }

            return valid;
        }
    </script>
</head>

<body>

    <h2>Admin Login</h2>

    <?php if(!empty($message)) { ?>
        <p style="color:green;">
            <?php echo $message; ?>
        </p>
    <?php } ?>

    <p>
        <span style="color:red;">* Required field</span>
    </p>

    <form method="post" onsubmit="return collect_data()" action="">

        <table>

            <tr>
                <td>
                    <label for="name">User Name:</label>
                </td>

                <td>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?php echo $name; ?>"
                    >
                </td>

                <td>
                    <span style="color:red;">*</span>
                    <?php echo $name; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="password">Password:</label>
                </td>

                <td>
                    <input
                        type="password"
                        id="password"
                        name="password"
                    >
                </td>

                <td>
                    <span style="color:red;">*</span>
                    <?php echo $password; ?>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <label class="remember">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >
                        Remember Me
                    </label>
                </td>
            </tr>

            <tr>
                <td colspan="3">
                    <input
                        type="submit"
                        id="login"
                        name="login"
                        value="Login"
                    >
                </td>
            </tr>

        </table>

    </form>

</body>
</html>