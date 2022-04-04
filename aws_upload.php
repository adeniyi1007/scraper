<?php
// Code to convert php array to xml document



function arrayToXml($array, $rootElement = null, $xml = null)
{
    $_xml = $xml;

    // If there is no Root Element then insert root
    if ($_xml === null) {
        $_xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
    }

    // Visit all key value pair
    foreach ($array as $k => $v) {

        // If there is nested array then
        if (is_array($v)) {

            // Call function for nested array
            arrayToXml($v, $k, $_xml->addChild($k));
        } else {

            // Simply add child element.
            $_xml->addChild($k, $v);
        }
    }

    return $_xml->asXML();
}



$config = new SellingPartnerApi\Configuration([
    "lwaClientId" => "<LWA client ID>",
    "lwaClientSecret" => "<LWA client secret>",
    "lwaRefreshToken" => "<LWA refresh token>",
    "awsAccessKeyId" => "<AWS access key ID>",
    "awsSecretAccessKey" => "<AWS secret access key>",
    "endpoint" => SellingPartnerApi\Endpoint::NA  // or another endpoint from lib/Endpoints.php
]);




$feedApi = new \ScrapingToolAmazonBLABLABLA\AmazonSellingPartnerAPI\Api\FeedsApi($config); //replace with the actual url

$contentType = 'text/xml; charset=UTF-8';

//replace with actual url too in createFeedDocument parameter
$feedDocument = $feedApi->createFeedDocument(new \ScrapingToolAmazonBLABLABLA\AmazonSellingPartnerAPI\Models\Feeds\CreateFeedDocumentSpecification([
    'content_type' => $contentType,
]));

$feedDocumentId = $feedDocument->getPayload()->getFeedDocumentId();
$url = $feedDocument->getPayload()->getUrl();
$key = $feedDocument->getPayload()->getEncryptionDetails()->getKey();
$key = base64_decode($key, true);
$initializationVector = base64_decode($feedDocument->getPayload()->getEncryptionDetails()->getInitializationVector(), true);
$encryptedFeedData = openssl_encrypt(utf8_encode(arrayToXml([ // this is where any data to be uploaded goes, NB: keys of array are converted into values and values of array are converted into element of xml
    'data' => 'test',
])), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $initializationVector);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 90,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_POSTFIELDS => $encryptedFeedData,
    CURLOPT_HTTPHEADER => [
        'Accept: application/xml',
        'Content-Type: ' . $contentType,
    ],
));

$response = curl_exec($curl);

$error = curl_error($curl);
$httpcode = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ($httpcode >= 200 && $httpcode <= 299) {
    // success
    $createFeedParams = [
        "feedType" => "POST_PRODUCT_DATA", //or replace with appropriate feed type for the kind of data being scraped
        "marketplaceIds" => ["A2EUQ1WTGCTBG2"], //Canada, NB: has to be an array
        "inputFeedDocumentId" => $feedDocumentId
    ];
    $r = $feedsApi->createFeed(json_encode($createFeedParams));
    print_r($r);
} else {
    // error
}







// require_once(__DIR__ . '/vendor/autoload.php');

// // See README for more information on the Configuration object's options
// $config = new SellingPartnerApi\Configuration([
//     "lwaClientId" => "<LWA client ID>",
//     "lwaClientSecret" => "<LWA client secret>",
//     "lwaRefreshToken" => "<LWA refresh token>",
//     "awsAccessKeyId" => "<AWS access key ID>",
//     "awsSecretAccessKey" => "<AWS secret access key>",
//     "endpoint" => SellingPartnerApi\Endpoint::NA  // or another endpoint from lib/Endpoints.php
// ]);

// $apiInstance = new SellingPartnerApi\Api\ListingsApi($config);
// $seller_id = 'seller_id_example'; // string | A selling partner identifier, such as a merchant account or vendor code.
// $sku = 'sku_example'; // string | A selling partner provided identifier for an Amazon listing.
// $marketplace_ids = ATVPDKIKX0DER; // string[] | A comma-delimited list of Amazon marketplace identifiers for the request.
// $body = new \SellingPartnerApi\Model\Listings\ListingsItemPutRequest(); // \SellingPartnerApi\Model\Listings\ListingsItemPutRequest | The request body schema for the putListingsItem operation.
// $issue_locale = en_US; // string | A locale for localization of issues. When not provided, the default language code of the first marketplace is used. Examples: \"en_US\", \"fr_CA\", \"fr_FR\". Localized messages default to \"en_US\" when a localization is not available in the specified locale.

// try {
//     $result = $apiInstance->putListingsItem($seller_id, $sku, $marketplace_ids, $body, $issue_locale);
//     print_r($result);
// } catch (Exception $e) {
//     echo 'Exception when calling ListingsApi->putListingsItem: ', $e->getMessage(), PHP_EOL;
// }