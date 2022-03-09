<?php

http://localhost/scraper/uploadimage?itemno=3042554000001096280&sku=393293242332&imageurl=https://www.reliableparts.ca/thumbnail/product/2572946/300/200&itemno=3042554000001096280

function fetchNewToken(){
    // refresh token was manually geenrated at first but will be used to generate subsequent tokens anytime the script runs since it does not expire.

    $zohoRefreshToken="1000.817d0ab31b74037bf90223ef64a7dd43.c47f525e007c494e869426bff0ed294f";
    
    // Make a post request to Zoho using the refresh token

    $client_id="1000.0UZCJPQ3LY43ZEQJA87HGE4ZEWD8XR"; // created at api-console
    $client_secret="7aa542eb4aa053319692da5d64fe6f5e630c11c594"; // created at api-console

    // call now
            // set post fields
        $post = [
            'refresh_token' => $zohoRefreshToken,
            'client_id' => $client_id,
            'client_secret'   => $client_secret,
            'grant_type'   => 'refresh_token',
        ];

        $ch = curl_init('https://accounts.zoho.com/oauth/v2/token');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // remove when going live
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        // execute!
        $response = curl_exec($ch);
        // close the connection, release resources used
        // if (curl_errno($ch)) {
        //     return curl_error($ch);
        // }
        curl_close($ch);
        // do anything you want with your response
        $return_data = json_decode($response, true);
        return $return_data["access_token"];
        //end call
}

// Fetch Access token 
$access_token=fetchNewToken();

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
        'Authorization: Bearer '.$access_token
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