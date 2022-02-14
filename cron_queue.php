<?php
include_once "config.php";

$query = "SELECT * FROM queue where status='1' LIMIT 20";
$sql = mysqli_query($connection, $query);

if (mysqli_num_rows($sql) > 0) {
    // UPDATE status=2 ( for all returned id);
    $updateQuery="UPDATE queue set status='2' where id in_array()";

    while($row = $sql->fetch_assoc()) {
        if ($row['status'] == '1') {
            $model = $row['data'];
            $url = "index.php?s=".$model."&scrapeupload=1";
 
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            
            $data = curl_exec($curl);
            
            curl_close($curl);
        }
    }

    $updateQuery="UPDATE queue set status='3' where id in_array()";
}