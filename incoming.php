<?php

function uploadItem($modelNumber,$action,$uploadData=false){
    

    if($uploadData) {
        
        
        $handle = curl_init('https://flow.zoho.com/771863076/flow/webhook/incoming?zapikey=1001.6d43c16859efed4e76b58670c5e8d9cb.7d41bb9f2305ba2929f041a9f491d7ca&isdebug=false'); 
        
        $encodedData = $modelNumber;
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