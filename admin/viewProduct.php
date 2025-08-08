<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "dbconnect.php";
try {
    $sql = "SELECT p.productId, p.productName, p.price, p.description, p.qty, p.imgPath, c.catName as category
from product p, category c WHERE
p.category = c.catId";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php require_once "navbarcopy.php" ?>

        </div>
        <div class="row"><!-- content    -->
            <div class="col-md-2 py-5">
                <a href="insertProduct2.php" class="btn btn-outline-primary">New Product</a>
            </div>
            <div class="col-md-10 py-5"><!-- content    -->
                <?php
                if (isset($_SESSION["message"])) {
                    echo "<p class='alert alert-success' style=width:500px>$_SESSION[message] </p>";
                    unset($_SESSION["message"]);
                }
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Category</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Description</td>
                            <td>Image</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $product) {
                            $desc = substr($product["description"],0,30);
                            echo "
                            <tr>
                            <td>$product[productName]</td>
                            <td>$product[category]</td>
                            <td>$product[price]</td>
                            <td>$product[qty]</td>
                            <td class='text-wrap'>$desc</td>
                            <td><img src = $product[imgPath] style=width:100px; height:100px;></td>
                            <td><a href='insert.php' class='btn btn-primary rounded pill'>Edit</a></td>
                            <td><a href='delete.php' class='btn btn-danger rounded pill'>Delete</a></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>