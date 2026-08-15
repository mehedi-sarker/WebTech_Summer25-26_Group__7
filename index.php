<?php

require_once "Config/Connection.php";
require_once "Models/Product.php";
require_once "Controller/ProductController.php";

$controller = new ProductController();

$products = $controller->latestProducts();

?>

<!DOCTYPE html>

<html>

<head>

    <title>Golazo Kits BD</title>

    <link rel="stylesheet" href="View/Design/design.css">

</head>

<body>

<?php include "View/Layout/header.php"; ?>


<h2 align="center">
    Latest Jerseys
</h2>


<div class="product-container">

<?php

while($row = mysqli_fetch_assoc($products))
{

?>

    <div class="card">

        <img src="<?php echo $row['Image']; ?>">

        <h3>
            <?php echo $row['ProductName']; ?>
        </h3>

        <p>
            <?php echo $row['Edition']; ?> Edition
        </p>

        <p>
            <?php echo $row['Price']; ?> Tk
        </p>

        <a href="productdetails.php?id=<?php echo $row['ProductID']; ?>">

            <button>
                View Details
            </button>

        </a>

    </div>

<?php

}

?>

</div>


<?php include "View/Layout/footer.php"; ?>

</body>

</html>