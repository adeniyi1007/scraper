<?php


if(isset($_GET["modelno"])){
    include_once "config.php";

    $models=$_GET["modelno"];

    $query = "INSERT INTO 
    queue (type, data, attempt, error, upload_date)
    VALUES ('flow','".$models."','','','')";
    $sql= mysqli_query($connection, $query);
    if ($sql) {
    echo "saved";
    }

}