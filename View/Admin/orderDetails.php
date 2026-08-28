<!DOCTYPE html>

<html>

<head>

    <title>Order #<?php echo $order['OrderID']; ?></title>

    <link rel="stylesheet" href="View/Design/design.css">

</head>

<body>

<?php include __DIR__ . "/../layout/header.php"; ?>


<div class="admin-container">

    <a href="index.php?page=admin-orders">&larr; Back to All Orders</a>

    <h2>Order #<?php echo $order['OrderID']; ?> - Billing Details</h2>

<?php if (!$order): ?>

    <p>Order not found.</p>

<?php else: ?>

    <div class="order-detail-box">

        <p><b>Customer Name:</b> <?php echo htmlspecialchars($order['CustomerName']); ?></p>
        <p><b>Phone:</b> <?php echo htmlspecialchars($order['Phone']); ?></p>
        <p><b>Billing Address:</b> <?php echo htmlspecialchars($order['BillingAddress']); ?></p>
        <p><b>Delivery Area:</b> <?php echo htmlspecialchars($order['DeliveryArea']); ?></p>
        <p><b>Delivery Charge:</b> <?php echo $order['DeliveryCharge']; ?> Tk</p>
        <p><b>Product Total:</b> <?php echo $order['ProductTotal']; ?> Tk</p>
        <p><b>Grand Total:</b> <?php echo $order['GrandTotal']; ?> Tk</p>
        <p><b>Status:</b> <?php echo htmlspecialchars($order['Status']); ?></p>
        <p><b>Order Date:</b> <?php echo $order['OrderDate']; ?></p>

    </div>


    <h3>Items In This Order</h3>

    <table class="admin-table">

        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Subtotal</th>
        </tr>

<?php while ($item = $items->fetch_assoc()): ?>

        <tr>
            <td><?php echo htmlspecialchars($item['ProductName']); ?></td>
            <td><?php echo $item['Quantity']; ?></td>
            <td><?php echo $item['UnitPrice']; ?> Tk</td>
            <td><?php echo $item['SubTotal']; ?> Tk</td>
        </tr>

<?php endwhile; ?>

    </table>

<?php endif; ?>

</div>


<?php include __DIR__ . "/../layout/footer.php"; ?>

</body>

</html>
