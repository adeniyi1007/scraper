<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scraper</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="" style="background:wheat">
    
<?php

require 'tool/simple_html_dom.php';

// $html = file_get_html('https://www.easyapplianceparts.ca/Search.ashx?SearchTerm=36361222101&SearchMethod=standard');
$html = file_get_html('https://www.partselect.ca/Models/36361222101/?SourceCode=11');

$title = $html->find('title', 0);
$image = $html->find('img', 0);

// echo $html->plaintext."<br>\n";
// echo $image->src;

$scrape_from= array(
    'easyappliance'=> "https://www.easyapplianceparts.ca/Search.ashx?SearchTerm=[SEARCH]&SearchMethod=standard",
    'reliablepart'=> "https://www.reliableparts.ca/search?q=[SEARCH]",
    'partsselect'=> "https://www.partselect.ca/Models/[SEARCH]/?SourceCode=11",
    'atlanticappliance'=> "https://www.zohoinventory?q=[SEARCH]",
);

// echo $html = file_get_html('https://www.easyapplianceparts.ca/Search.ashx?SearchTerm=36361222101&SearchMethod=standard')->plaintext;
// $html->find('div.mega-m__part__price', 0)->first_child()->innertext = "";
// $price = $html->find('div.mega-m__part__price', 0)->plaintext;
$price = $html->find('div.mb-1', 0)->plaintext;
// $p = $html->find('div.mega-m__part__price', 0)->plaintext;
echo $price;
// echo $p;
// $a = explode('$',$price);
// echo (int) $a[1];

// Find all article blocks
foreach($html->find('div.article') as $article) {
    $item['title']     = $article->find('div.title', 0)->plaintext;
    $item['intro']    = $article->find('div.intro', 0)->plaintext;
    $item['details'] = $article->find('div.details', 0)->plaintext;
    $articles[] = $item;
}

// print_r($partList);

?>

</body>
</html>