<?php
// just for test purpose, to test remove te underscrore
// echo uploadItem("Item Final Test 2","8 .3654","Just a desc","imgLink","partNo","ModelNum",true);

function uploadItem($item_name,$item_price,$item_desc,$item_img,$item_part_no,$item_model_num,$uploadScrapedData=false){
    
    $item_price=trim(str_replace("$","",$item_price));
    $item_price=round($item_price);

    // assign an SKU

    $sql_q = mysqli_query($connection, "SELECT sku FROM sku where part_no='' order by id asc");
    if (mysqli_num_rows($sql_q) > 0) {
        while($row = $sql_q->fetch_assoc()) {
            if (!empty($row['sku'])) {
                $sku=$row['sku'];
            }
            
        }
        mysqli_query($connection, "UPDATE sku SET part_no='$item_part_no' where part_no='' and sku='$sku' LIMIT 1");
    }

    if($uploadScrapedData) {
        $data = [
            'item_scraped_name' => $item_name,
            'item_scraped_price' => $item_price,
            'item_description' => trim($item_desc),
            'item_img' => $item_img,
            'item_part_no' => $item_part_no,
            'item_model_no' => $item_model_num,
            'item_sku_no' => $sku
        ];
        
        $handle = curl_init('https://flow.zoho.com/771863076/flow/webhook/incoming?zapikey=1001.6d43c16859efed4e76b58670c5e8d9cb.7d41bb9f2305ba2929f041a9f491d7ca&isdebug=false'); 
        
        $encodedData = $data;
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $encodedData);
        curl_setopt($handle, CURLOPT_FAILONERROR, true); 
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); 
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);   
        $result = curl_exec($handle);
        $httpcode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        // print_r($result = json_decode($result, true));
        curl_close($handle);
        return $httpcode;
    }
}


// Access tokens
// {
//     "access_token": "1000.7070ab1293c0eb194ff145066cff2246.6913b58f661da16e034ec1074d4f01de",
//     "refresh_token": "1000.817d0ab31b74037bf90223ef64a7dd43.c47f525e007c494e869426bff0ed294f",
//     "api_domain": "https://www.zohoapis.com",
//     "token_type": "Bearer",
//     "expires_in": 3600
//   }


?>