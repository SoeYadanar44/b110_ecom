<?php
require_once "dbconnect.php";
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['eid'])) {
    //echo "edit button clicked";
    $productId = $_GET['eid'];
    try {
        
    }catch (PDOException $e) {

    }
} else if (isset($_GET['did'])) {
    try {
        $productId = $_GET['did'];
        $sql = "delete from product where productId=?";
        $stmt = $con->prepare($sql);//prevent SQL injection attack using prepare
        $status = $stmt->execute([$productId]);
        if($status) {
            $_SESSION['deleteSuccess']="product ID $productId has been deleted.";
            header("Location: viewProduct.php");
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
