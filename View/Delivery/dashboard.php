<!DOCTYPE html>

<html>

<head>

    <title>Delivery Dashboard</title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php include __DIR__ . "/../Layout/header.php"; ?>


<div class="auth-container">

    <h2>Delivery Man Dashboard</h2>

    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>.</p>

    <p>Assigned orders and delivery status updates will go here.</p>

</div>


<?php include __DIR__ . "/../Layout/footer.php"; ?>


</body>

</html>
