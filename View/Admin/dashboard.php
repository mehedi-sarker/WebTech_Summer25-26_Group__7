<!DOCTYPE html>

<html>

<head>

    <title>Admin Dashboard</title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php include __DIR__ . "/../Layout/header.php"; ?>


<div class="auth-container">

    <h2>Admin Dashboard</h2>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>

    <p>Order management, product management, and delivery man assignment will go here.</p>

</div>


<?php include __DIR__ . "/../Layout/footer.php"; ?>


</body>

</html>
