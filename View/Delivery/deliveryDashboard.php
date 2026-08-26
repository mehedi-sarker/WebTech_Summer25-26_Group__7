<?php include "../../Controller/DeliveryController.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Delivery Dashboard </title>
        <link rel="stylesheet" href="../Design/design.css">
        <link rel="stylesheet" href="../Design/delivery.css">
        <script src="../../JS/UpdateStatus.js"></script>
    </head>
    <body>

        <header>
            <h1>Golazo Kits BD — Delivery Panel</h1>
            <nav>
                <a href="deliveryDashboard.php">Dashboard</a>
                <a href="../../index.php?page=logout">Logout</a>
            </nav>
        </header>

        <div class="delivery-wrapper">

            <h2> Welcome, <?php echo $username; ?> </h2>

            <form action="" method="post">
                <input type="submit" name="view" value="Pending">
                <input type="submit" name="view" value="Shipped">
                <input type="submit" name="view" value="Delivered">
            </form>

            <h3> Showing: <?php echo $status; ?> Orders </h3>

            <?php
            if($orders->num_rows == 0){
                echo "<p> No orders found </p>";
            }
            while($row = $orders->fetch_assoc()){
            ?>

                <div class="order-box" id="order<?php echo $row["OrderID"]; ?>">
                    <?php
                    echo "<p> Order ID: ".$row["OrderID"]." </p>";
                    echo "<p> Customer Name: ".$row["CustomerName"]." </p>";
                    echo "<p> Phone: ".$row["Phone"]." </p>";
                    echo "<p> Address: ".$row["BillingAddress"]." </p>";
                    echo "<p> Area: ".$row["DeliveryArea"]." </p>";
                    echo "<p> Total to Collect: ".$row["GrandTotal"]." Tk </p>";
                    echo "<p> Status: ".$row["Status"]." </p>";
                    ?>

                    <?php if($row["Status"] == "Pending"){ ?>
                        <input type="button" value="Mark as Shipped" onclick="updateStatus(<?php echo $row["OrderID"]; ?>, 'Shipped')">
                    <?php }else if($row["Status"] == "Shipped"){ ?>
                        <input type="button" value="Mark as Delivered" onclick="updateStatus(<?php echo $row["OrderID"]; ?>, 'Delivered')">
                    <?php }else{ ?>
                        <p> Done </p>
                    <?php } ?>
                </div>

            <?php } ?>

        </div>

        <footer>
            <hr>
            <p class="copyright">
                © 2026 Golazo Kits BD — Delivery Panel <br>
                A Product by Mehedi Sarker
            </p>
        </footer>

    </body>
</html>