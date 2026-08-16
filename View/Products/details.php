<!DOCTYPE html>

<html>

<head>

    <title><?php echo $product ? $product['ProductName'] : "Product Not Found"; ?></title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php

include __DIR__ . "/../Layout/header.php";

?>


<?php

if (!$product)
{

?>

    <h2>Product Not Found</h2>

<?php

}
else
{

?>


<div class="details-container">


    <div class="image-section">

        <img
            src="<?php echo $product['Image']; ?>"
            alt="<?php echo $product['ProductName']; ?>"
        >

    </div>


    <div class="info-section">


        <form action="index.php?page=cart" method="POST">

            <input
                type="hidden"
                name="productid"
                value="<?php echo $product['ProductID']; ?>"
            >


            <h2>

                <?php echo $product['ProductName']; ?>

            </h2>


            <p>

                <b>Club :</b>

                <?php echo $product['Club']; ?>

            </p>


            <p>

                <b>Category :</b>

                <?php echo $product['Category']; ?>

            </p>


            <p>

                <b>Edition :</b>

                <?php echo $product['Edition']; ?>

            </p>


            <p>

                <b>Stock :</b>

                <?php echo $product['Stock']; ?>

            </p>


            <h3>

                Price :
                Tk
                <span id="price">

                    <?php echo $product['Price']; ?>

                </span>

            </h3>


            <div class="size-section">

                <b>Select Size</b>

                <br><br>

                <label>
                    <input type="radio" name="size" value="S" required>
                    S
                </label>

                <label>
                    <input type="radio" name="size" value="M">
                    M
                </label>

                <label>
                    <input type="radio" name="size" value="L">
                    L
                </label>

                <label>
                    <input type="radio" name="size" value="XL">
                    XL
                </label>

                <label>
                    <input type="radio" name="size" value="XXL">
                    XXL
                </label>

            </div>


            <div class="quantity-section">

                <b>Quantity</b>

                <br><br>

                <button type="button" onclick="decreaseQuantity()">-</button>

                <input
                    type="text"
                    id="quantity"
                    name="quantity"
                    value="1"
                    readonly
                >

                <button type="button" onclick="increaseQuantity()">+</button>

            </div>


            <div class="total-section">

                Total :
                Tk
                <span id="totalPrice">

                    <?php echo $product['Price']; ?>

                </span>

            </div>


            <input
                type="submit"
                name="addcart"
                value="Add To Cart"
                class="add-cart-btn"
            >


        </form>


    </div>


</div>


<script>

var price = <?php echo $product['Price']; ?>;

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
