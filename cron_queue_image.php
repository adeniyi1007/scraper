<?php
include_once "config.php";

// $query = "SELECT * FROM `queue` where `status` = 1 LIMIT 0, 20";
$query = "SELECT * FROM queue where type='flow_item_image' and status='1' LIMIT 10";
$sql = mysqli_query($connection, $query);

if (mysqli_num_rows($sql) > 0) {
     
    // UPDATE status=2 ( for all returned id);
       
    while ($row = $sql->fetch_assoc()) {
        // array_push($id, $row['id']);
        if ($row['status'] == '1') {
        $id = $row['id']; 
        // echo $row['id'];
        $updateQuery="UPDATE queue SET status='2' WHERE id = $id ";
        $updateSql = mysqli_query($connection, $updateQuery);
        $raw_data = $row['data'];
        $explode=explode("|",$raw_data);
        $item_no=$explode[0];
        $sku=$explode[1];
        $img=$explode[3];
            $url = "https://aascraper.xyz/uploadimage.php?itemno=$item_no&sku=$sku&imageurl=$img";
 
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            
            $data = curl_exec($curl);
            
            curl_close($curl);
            $updateQuery1 = "UPDATE queue SET status='3',upload_date=NOW() WHERE id = $id";
            $updateSql1 = mysqli_query($connection, $updateQuery1);
        }
        sleep(3);
    }

}