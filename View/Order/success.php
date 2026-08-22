<!DOCTYPE html>

<html>

<head>

    <title>Order Placed</title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php include __DIR__ . "/../Layout/header.php"; ?>


<div class="order-success-container">

    <h2>Thank You For Your Order!</h2>

<?php if ($orderId): ?>

    <p>Your order number is <b>#<?php echo $orderId; ?></b>.</p>

<?php endif; ?>

    <p>We've received your order and will contact you shortly to confirm delivery.</p>

    <a href="index.php?page=products" class="checkout-btn" style="display:inline-block; text-decoration:none; width:auto; padding:12px 30px;">
        Continue Shopping
    </a>

</div>


<?php include __DIR__ . "/../Layout/footer.php"; ?>


</body>

</html>
