<?php include __DIR__ . "/../../Controller/ResetValidation.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Reset Password </title>
        <link rel="stylesheet" href="View/Design/design.css">
        <script>
            function collect_data()
            {
                let name = document.getElementById("name").value.trim();
                let newp = document.getElementById("new_password").value.trim();
                let confirmp = document.getElementById("confirm_password").value.trim();
                let valid = true;
                let message = "";
                if(name.length < 1)
                {
                    message += "Username is required\n";
                    valid = false;
                }
                if(newp.length < 5)
                {
                    message += "New Password must be at least 5 characters\n";
                    valid = false;
                }
                if(confirmp !== newp)
                {
                    message += "Confirm Password must match New Password\n";
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
        <div class="auth-container">
            <h2> Reset Password </h2>
            <?php if(!empty($message)){ ?>
                <p class="auth-error"><?php echo $message; ?></p>
            <?php } ?>
            <form method="post" action="index.php?page=reset-password" onsubmit="return collect_data()">
                <table>
                    <tr>
                        <td> <label for="name"> Username: </label></td>
                        <td> <input type="text" id="name" name="name" required></td>
                    </tr>
                    <tr>
                        <td> <label for="new_password"> New Password: </label></td>
                        <td> <input type="password" id="new_password" name="new_password" required></td>
                    </tr>
                    <tr>
                        <td> <label for="confirm_password"> Confirm Password: </label></td>
                        <td> <input type="password" id="confirm_password" name="confirm_password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="reset" value="Reset Password" class="add-cart-btn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php include __DIR__ . "/../layout/footer.php"; ?>
    </body>
</html>