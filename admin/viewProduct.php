<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "dbconnect.php";
try {
    $sql = "select * from category";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
} catch (PDOException $e) {
    echo $e->getMessage();
}
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

if (isset($_GET['bsearch'])) {
    $text = $_GET['tsearch'];
    try {
        $sql = "SELECT p.productId, p.productName, p.price, p.description, p.qty, p.imgPath, c.catName as category
                from product p, category c WHERE
                p.category = c.catId and
                p.productName like ?";
        $stmt = $con->prepare($sql);
        $stmt->execute(["%" . $text . "%"]);
        $products = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} //if end
else if (isset($_GET['cSearch'])) {
    $cid = $_GET['category']; //1,2,3,4,5
    try {
        $sql = "SELECT p.productId, p.productName, p.price, p.description, p.qty, p.imgPath, c.catName as category
from product p, category c WHERE
p.category = c.catId
and c.catId = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$cid]);
        $products = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} //else if end
else if (isset($_POST['radioBtn'])) {
    $price = $_POST['price'];
    if ($price == "first") {
        $lower = 200;
        $upper = 300;
    } else if ($price == "second") {
        $lower = 301;
        $upper = 500;
    }
    try {
        $sql = "SELECT p.productId, p.productName, p.price, p.description, p.qty, p.imgPath, 
                c.catName as category
                FROM product p, category c
                WHERE p.price BETWEEN ? AND ? AND
                c.catId = p.category";
        $stmt = $con->prepare($sql);
        $stmt->execute([$lower, $upper]);
        $products = $stmt->fetchAll();
    } catch (PDOException $e) {
    }
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
            <div class="col-md-2 py-5 px-5">
                <div class="card">
                    <a href="insertProduct2.php" class="btn btn-outline-primary">New Product</a>
                </div>
                <div class="card">
                    <div class="card-title">Category Search</div>
                    <div class="card-body">
                        <form class="form" method="get" action="viewProduct.php">
                            <select name="category" id="" class="form-select mb-2">
                                <?php
                                foreach ($categories as $category) {
                                    echo "<option value=$category[catId]>$category[catName]</option>";
                                }

                                ?>
                            </select>
                            <button type="submit" name="cSearch" class="btn btn-outline-primary rounded-pill">Search</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-3 mt-3">
                    <form class="form" action="viewProduct.php" method="post">
                        <div class="form-check mb-2">
                            <input type="radio" value="first" name="price" class="form-check-input">
                            <label for="" class="form-check-label">$200-$300</label>
                        </div>
                        <div class="form-check mb-2">
                            <input type="radio" value="second" name="price" class="form-check-input">
                            <label for="" class="form-check-label">$301-$500</label>
                        </div>
                        <div class="mb-2">
                            <button name="radioBtn" class="btn btn-outline-primary rounded-pill">
                                Search
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-9 py-5"><!-- content    -->
                <?php
                if (isset($_SESSION["message"])) {
                    echo "<p class='alert alert-success' style=width:500px>$_SESSION[message] </p>";
                    unset($_SESSION["message"]);
                } else if (isset($_SESSION['deleteSuccesstable view'])) {
                    echo "<p class='alert alert-success'>$_SESSION[deleteSuccess] </p>";
                    unset($_SESSION['deleteSuccess']);
                } else if (isset($_SESSION['updateMessage'])) {
                    echo "<p class='alert alert-success'>$_SESSION[updateMessage]</p>";
                    unset($_SESSION["updateMessage"]);
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
                            $desc = substr($product["description"], 0, 30);
                            echo "
                            <tr>
                            <td>$product[productName]</td>
                            <td>$product[category]</td>
                            <td>$product[price]</td>
                            <td>$product[qty]</td>
                            <td class='text-wrap'>$desc</td>
                            <td><img src = $product[imgPath] style=width:100px; height:100px;></td>
                            <td><a href=editDelete.php?eid=$product[productId] class='btn btn-primary rounded pill'>Edit</a></td>
                            <td><a href=editDelete.php?did=$product[productId] class='btn btn-danger rounded pill'>Delete</a></td>
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