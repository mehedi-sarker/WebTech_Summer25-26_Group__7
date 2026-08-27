<?php
include "../../Controller/signupvalidation.php";
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Sign UP</title>
            <link rel="stylesheet" href="../Design/signup.css">

    <script>
        function collect_data()
        {
            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();
            let confirm_password = document.getElementById("confirm_password").value.trim();
            let address = document.getElementById("address").value.trim();
            let message ="";
 
            if(name.length<1)
            {
                message+="Name is required";
                valid=false;
            }
 
            if(email.length<1)
            {
                message+="Email is required";
                valid=false;
            }
            else if(!email.includes("@"))
            {
                message+="Email must contain @";
                valid=false;
            }
            else if(!email.includes(".com"))
            {
                message+="Email must contain .com";
                valid=false;
            }
            else if(email !== email.toLowerCase())
            {
                message+="Email must be in small letters";
                valid=false;
            } 
            if(password.length<1)
            {
                message+="Password is required";
                valid=false;
            }
            else if(password.length<8)
            {
                message+="Password must be at least 8 characters long";
                valid=false;
            }
            if(confirm_password.length<1)
            {
                message+="Confirm Password is required";
                valid=false;
            }
            else if(confirm_password !== password)
            {
                message+="Confirm Password must match Password";
                valid=false;
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
    <h2>Sign Up</h2>
 
    <?php if(!empty($message)) { ?>
        <p style="color:green;"> <?php echo $message; ?> </p>
    <?php } ?>
 
    <p><span style="color:red;">* Required field</span></p>
 
    <form method="post" onsubmit="return collect_data()" action="">
    <table>
        <tr>
            <td> <label for="name">Name:</label> </td>
            <td> <input type="text" id="name" name="name"> </td>
            <td> <span style="color:red;">*</span> <?php echo $name; ?> </td>
        </tr>
        <tr>
            <td> <label for="email">Email:</label> </td>
            <td> <input type="text" id="email" name="email"> </td>
            <td> <span style="color:red;">*</span> <?php echo $email; ?> </td>
        </tr>
         <tr>
            <td> <label for="password">Password:</label> </td>
            <td> <input type="password" id="password" name="password"> </td>
            <td> <span style="color:red;">*</span> <?php echo $password; ?> </td>
        </tr> <tr>
            <td> <label for="confirm_password">Confirm Password:</label> </td>
            <td> <input type="password" id="confirm_password" name="confirm_password"> </td>
            <td> <span style="color:red;">*</span> <?php echo $confirm_password; ?> </td>
        </tr> <tr>
            <td> <label for="address">Address:</label> </td>
            <td> <textarea id = "address" name="address" cols="20" rows="5" style="resize:none">  
            </textarea> </td>
            <td> <span style="color:red;">*</span> <?php echo $address; ?> </td>
        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" id="submit" name="submit" value="Sign Up">
            </td>
        </tr>
    </table>
    </form>
    </body>
</html>