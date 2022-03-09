<?php


if(isset($_GET["itemno"])){
    include_once "config.php";

    $models=$_GET["modelno"];

    $data=$_GET["itemno"]."|".$_GET["sku"]."|".$_GET["partno"]."|".$_GET["img"];

    $query = "INSERT INTO 
    queue (type, data, attempt, error, upload_date)
    VALUES ('flow_item_image','".$data."','','','')";
    $sql= mysqli_query($connection, $query);
    if ($sql) {
    echo "saved";
    }

}