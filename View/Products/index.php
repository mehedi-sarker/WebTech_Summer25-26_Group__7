<!DOCTYPE html>

<html>

<head>

    <title>Products</title>

    <link rel="stylesheet"
          href="View/Design/design.css">

</head>


<body>


<?php

include __DIR__ . "/../Layout/header.php";

?>


<div class="product-container">


<?php

if (mysqli_num_rows($products) == 0)
{
    echo "<h2>No Products Found</h2>";
}


while ($row = mysqli_fetch_assoc($products))
{

?>


    <div class="card">


        <img
            src="<?php echo $row['Image']; ?>"
            alt="<?php echo $row['ProductName']; ?>"
        >


        <h3>

            <?php echo $row['ProductName']; ?>

        </h3>


        <p>

            <?php echo $row['Edition']; ?>

            Edition

        </p>


        <p>

            <?php echo $row['Price']; ?>

            Tk

        </p>


        <a
            href="productdetails.php?id=<?php echo $row['ProductID']; ?>"
        >

            <button>

                View Details

            </button>

        </a>


    </div>


<?php

}

?>


</div>


<?php

include __DIR__ . "/../Layout/footer.php";

?>


</body>

</html>