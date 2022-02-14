<?php
include_once "config.php";

// $query = "SELECT * FROM `queue` where `status` = 1 LIMIT 0, 20";
$query = "SELECT * FROM queue LIMIT 0, 20";
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
        $model = $row['data'];
            $url = "https://aascraper.xyz/?submit=1&s=$model&scrapeupload=1";
 
            $curl = curl_init();
            
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            
            $data = curl_exec($curl);
            
            curl_close($curl);
            $updateQuery1 = "UPDATE queue SET status='3' WHERE id = $id";
            $updateSql1 = mysqli_query($connection, $updateQuery1);
        }
    }
    
    // $id = array();
    
    // print_r($id);
    // $id_values = array_values($id);
    // print_r(implode(',', $id_values));
    // $updateQuery="UPDATE queue SET status='2' WHERE id IN (" . implode(',', $id_values) . ")";
    // $updateSql = mysqli_query($connection, $updateQuery);
    
    // // while($row = $sql->fetch_assoc()) {
        
    // //         $model = $row['data'];
    // //         $url = "index.php?s=".$model."&scrapeupload=1";
 
    // //         $curl = curl_init();
            
    // //         curl_setopt($curl, CURLOPT_URL, $url);
    // //         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // //         curl_setopt($curl, CURLOPT_HEADER, false);
            
    // //         $data = curl_exec($curl);
            
    // //         curl_close($curl);
    // //         // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // //         // echo $httpcode;
        
    // // }
    // $updateQuery1="UPDATE queue SET status='3' WHERE 'id' IN (" . implode(',', $id_values) . ")";
    // $updateSql1 = mysqli_query($connection, $updateQuery1);

}