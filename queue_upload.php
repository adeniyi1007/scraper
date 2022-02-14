<?php
include_once "config.php";

$mode = mysqli_real_escape_string($connection, $_GET['mode']);
$models = mysqli_real_escape_string($connection, $_GET['s']);


if ($mode == 'scrapequeue' && !empty($models)) {
    if (strpos($models, ',')) {
        $model_array = explode(',', $models);
        $values = array();
        foreach ($model_array as $model) {
            $values[] = "('','".$model."','','','')";
            
        }
        $query = "INSERT INTO 
                    queue (type, data, attempt, error, upload_date)
                VALUES ".implode(',', $values);
        $sql= mysqli_query($connection, $query);
        
    } else {
        $query = "INSERT INTO 
                    queue (type, data, attempt, error, upload_date)
                VALUES ('','".$models."','','','')";
        $sql= mysqli_query($connection, $query);
}
}


