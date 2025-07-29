<?php
    require_once "dbconnect.php";
    try {
        $sql = "select * from category";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
    
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</head>

<body>
    <div class="contianer-fluid">
        <div class="row">
            <?php require_once "navbarcopy.php"; ?>
        </div>
        <div class="row mx-auto">
            <div class="col-md-9">
                <form class="form" action="insertProduct.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label for="pname" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="pname">
                        </div>
                        
                        <div class="mb-1">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price">
                        </div>
                        <select name="category" class="form-select">
                            <option value="">Choose Category</option>
                            <?php
                            if(isset($categories)) {
                                foreach($categories as $category) {
                                 echo "<option value=$category[catId]>$category[catName] </option>";
                                }
                            }
    
                            ?>
                        </select>
                        

                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>