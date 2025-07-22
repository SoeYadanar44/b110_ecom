<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "golden_city";
    //creating date source name
    $dsn = "mysql:host=$hostname; dbname=$dbname";

    try{
        $con = new PDO( $dsn, $username, $password );
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
        //echo "Success connection";

    }catch(PDOException $e){
        echo "". $e->getMessage();
    }



?>