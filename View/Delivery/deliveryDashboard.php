<?php include "../../Controller/DeliveryController.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Delivery Dashboard </title>
        <link rel="stylesheet" href="../Design/design.css">
        <link rel="stylesheet" href="delivery.css">
        <script>
            function confirm_update()
            {
                let ok = confirm("Update this order?");
                return ok;
            }
        </script>
    </head>
    <body>

        <header>
            <h1>Golazo Kits BD — Delivery Panel</h1>
            <nav>
                <a href="deliveryDashboard.php">Dashboard</a>
                <a href="../../index.php?page=logout">Logout</a>
            </nav>
        </header>

        <div class="delivery-container">

            <h2> Welcome, <?php echo $username; ?> (Delivery Man) </h2>

            <?php if($message != ""){ ?>
                <p class="success-msg"><?php echo $message; ?></p>
            <?php } ?>

            <form action="" method="get" class="tab-buttons">
                <input type="submit" name="view" value="Pending">
                <input type="submit" name="view" value="Shipped">
                <input type="submit" name="view" value="Delivered">
            </form>

            <h3> Showing: <?php echo $status; ?> Orders </h3>

            <table class="delivery-table">
                <tr>
                    <th class="col-id"> Order ID </th>
                    <th class="col-name"> Customer Name </th>
                    <th class="col-phone"> Phone </th>
                    <th class="col-address"> Address </th>
                    <th class="col-status"> Area </th>
                    <th class="col-status"> Total (Collect) </th>
                    <th class="col-status"> Status </th>
                    <th class="col-action"> Action </th>
                </tr>

                <?php
                if(mysqli_num_rows($orders) == 0){
                    echo "<tr><td colspan='8'> No orders found </td></tr>";
                }
                while($row = mysqli_fetch_assoc($orders)){
                    $statusClass = "status-pending";
                    if($row["Status"] == "Shipped") $statusClass = "status-shipped";
                    if($row["Status"] == "Delivered") $statusClass = "status-delivered";
                ?>
                <tr>
                    <td> <?php echo $row["OrderID"]; ?> </td>
                    <td> <?php echo $row["CustomerName"]; ?> </td>
                    <td> <?php echo $row["Phone"]; ?> </td>
                    <td> <?php echo $row["BillingAddress"]; ?> </td>
                    <td> <?php echo $row["DeliveryArea"]; ?> </td>
                    <td> <?php echo $row["GrandTotal"]; ?> Tk </td>
                    <td class="<?php echo $statusClass; ?>"> <?php echo $row["Status"]; ?> </td>
                    <td>
                        <?php if($row["Status"] == "Pending"){ ?>
                            <form action="" method="post" onsubmit="return confirm_update()">
                                <input type="hidden" name="order_id" value="<?php echo $row["OrderID"]; ?>">
                                <input type="hidden" name="delivery_status" value="Shipped">
                                <input type="submit" name="update_status" value="Mark as Shipped">
                            </form>
                        <?php }else if($row["Status"] == "Shipped"){ ?>
                            <form action="" method="post" onsubmit="return confirm_update()">
                                <input type="hidden" name="order_id" value="<?php echo $row["OrderID"]; ?>">
                                <input type="hidden" name="delivery_status" value="Delivered">
                                <input type="submit" name="update_status" value="Mark as Delivered">
                            </form>
                        <?php }else{ echo "Done"; } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>

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