<!DOCTYPE html>

<html>

<head>

    <title>Shopping Cart</title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php

include __DIR__ . "/../Layout/header.php";

?>


<?php

if (empty($cartItems))
{

?>

    <h2 align="center">Your Cart is Empty.</h2>

<?php

}
else
{

    $subtotal = 0;

?>


<form action="index.php?page=cart" method="POST">

<div class="cart-container">


    <!--=========================
            CUSTOMER SECTION
    ==========================-->

    <div class="customer-section">

            <h2>Billing Details</h2>

            <br>

            <label>Full Name</label>
            <br>
            <input type="text" name="customername" required>
            <br><br>

            <label>Phone Number</label>
            <br>
            <input type="text" name="phone" required>
            <br><br>

            <label>Division</label>
            <br>
            <input type="text" name="division" required>
            <br><br>

            <label>District</label>
            <br>
            <input type="text" name="district" required>
            <br><br>

            <label>Area / Thana</label>
            <br>
            <input type="text" name="area" required>
            <br><br>

            <label>Full Address</label>
            <br>
            <textarea name="address" rows="5" required></textarea>
            <br><br>

            <label>Order Note</label>
            <br>
            <textarea name="note" rows="3"></textarea>
            <br><br>

            <h3>Delivery Area</h3>
            <br>

            <label>
                <input
                    type="radio"
                    name="delivery"
                    value="80"
                    onclick="calculateGrandTotal()"
                    required
                >
                Inside Dhaka (80 Tk)
            </label>
            <br><br>

            <label>
                <input
                    type="radio"
                    name="delivery"
                    value="130"
                    onclick="calculateGrandTotal()"
                >
                Outside Dhaka (130 Tk)
            </label>

    </div>


            <!--=========================
                    CART SUMMARY
            ==========================-->

            <div class="summary-section">

                <h2>Your Cart</h2>

                <br>

<?php

    foreach ($cartItems as $item)
    {
        $total = $item['Price'] * $item['Quantity'];

        $subtotal += $total;

?>

                <div class="cart-item">

                    <div class="cart-image">

                        <img src="<?php echo $item['Image']; ?>">

                    </div>

                    <div class="cart-details">

                        <h3><?php echo $item['ProductName']; ?></h3>

                        <p>
                            <b>Size :</b>
                            <?php echo $item['Size']; ?>
                        </p>

                        <p>
                            <b>Price :</b>
                            <?php echo $item['Price']; ?> Tk
                        </p>

                        <div class="cart-quantity">

                            <a
                                href="index.php?page=cart&decrease=<?php echo $item['Index']; ?>"
                                class="qty-btn"
                            >
                                -
                            </a>

                            <span>

                                <?php echo $item['Quantity']; ?>

                            </span>

                            <a
                                href="index.php?page=cart&increase=<?php echo $item['Index']; ?>"
                                class="qty-btn"
                            >
                                +
                            </a>

                        </div>

                        <p>
                            <b>Total :</b>
                            <?php echo $total; ?> Tk
                        </p>

                        <a
                            href="index.php?page=cart&remove=<?php echo $item['Index']; ?>"
                            class="remove-btn"
                        >
                            Remove Item
                        </a>

                    </div>

                </div>

<?php

    }

?>

                <hr>

                <h3>

                    Subtotal :
                    Tk
                    <span id="subtotalPrice">

                        <?php echo $subtotal; ?>

                    </span>

                </h3>

                <br>

                <h3>

                    Delivery Charge :
                    Tk
                    <span id="deliveryCharge">

                        0

                    </span>

                </h3>

                <br>

                <h2>

                    Grand Total :
                    Tk
                    <span id="grandTotal">

                        <?php echo $subtotal; ?>

                    </span>

                </h2>

                <br><br>

                <input
                    type="submit"
                    name="checkout"
                    value="Checkout"
                    class="checkout-btn"
                >

            </div>


</div>


</form>


<script>

var subtotal = <?php echo $subtotal; ?>;

</script>

<script src="View/Script/script.js"></script>


<?php

}

?>


<?php

include __DIR__ . "/../Layout/footer.php";

?>


</body>

</html>
