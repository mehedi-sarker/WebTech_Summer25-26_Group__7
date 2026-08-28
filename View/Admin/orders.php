<!DOCTYPE html>

<html>

<head>

    <title>Manage Orders</title>

    <link rel="stylesheet" href="View/Design/design.css">

</head>

<body>

<?php include __DIR__ . "/../layout/header.php"; ?>


<div class="admin-container">

    <h2>All Orders</h2>

    <table class="admin-table">

        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Grand Total</th>
            <th>Status</th>
            <th>Date</th>
        </tr>

<?php while ($row = $orders->fetch_assoc()): ?>

        <tr>
            <td>
                <a href="index.php?page=admin-order-details&id=<?php echo $row['OrderID']; ?>">
                    #<?php echo $row['OrderID']; ?>
                </a>
            </td>
            <td><?php echo htmlspecialchars($row['CustomerName']); ?></td>
            <td><?php echo htmlspecialchars($row['Phone']); ?></td>
            <td><?php echo $row['GrandTotal']; ?> Tk</td>
            <td><?php echo htmlspecialchars($row['Status']); ?></td>
            <td><?php echo $row['OrderDate']; ?></td>
        </tr>

<?php endwhile; ?>

    </table>

</div>


<?php include __DIR__ . "/../layout/footer.php"; ?>

</body>

</html>
