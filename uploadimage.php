<?php

// http://localhost/scraper/uploadimage?itemno=3042554000001096280&sku=393293242332&imageurl=https://www.reliableparts.ca/thumbnail/product/2572946/300/200&itemno=3042554000001096280

$sku=$_GET["sku"];
$image_path=$_GET["imageurl"];
$localimgname = $sku.'.jpg'; 
  
// Function to write image into file
// imagepng(imagecreatefromstring(file_get_contents($image_path)), "output.png");
file_put_contents($localimgname, file_get_contents($image_path));

$image_path=$localimgname;
$itemid=$_GET["itemno"];

function makeCurlFile($file){
    $mime = mime_content_type($file);
    $info = pathinfo($file);
    $name = $info['basename'];
    $output = new CURLFile($file, $mime, $name);
    return $output;
}

    $url = "https://inventory.zoho.com/api/v1/items/$itemid/image"; 
    
    $ch = curl_init();
    // $file = new \CURLFile($image_path); //<-- Path could be relative
    $imageToUpload = makeCurlFile($image_path);
    $data = array('organization_id'=>'770273854','image' => $imageToUpload);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer 1000.3b26b3dd8139c4f2421baa1aab077037.2efca6845e23eb254a045cb4744ebc9c'
    ));
    //CURLOPT_SAFE_UPLOAD defaulted to true in 5.6.0
    //So next line is required as of php >= 5.6.0
    curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    // curl_setopt($ch, CURLOPT_ENCODING, "");
    // curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_exec($ch);

unlink($localimgname);
?>