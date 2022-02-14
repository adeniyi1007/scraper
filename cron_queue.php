<?php
include_once "config.php";

$query = "SELECT * FROM queue";
$sql = mysqli_query($connection, $query);

if (mysqli_num_rows($sql) > 0) {
    while($row = $sql->fetch_assoc()) {
        if ($row['status'] == '1') {
            $model = $row['data'];
            $url = "index.php?s=".$model."&scrapenow=1&uploadnow=1";
 
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            
            $data = curl_exec($curl);
            
            curl_close($curl);
        }
    }
}