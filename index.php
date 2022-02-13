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
    
<center>
<h1> Atlantic Appliance Scraper Tool </h1>
<p>This tool will scrape and upload parts to Zoho Inventory -> Amazon</p>

<form class='w-50 mx-auto' action="" method="get">
<div class="input-group mb-3">
  <select class="form-control" name="mode">
  <option value="Scrape">Scrape Mode Only - </option>
  <option value="scrapequeue">Scrape & Queue for Upload</option>
  <option value="scrapeupload">Scrape & Upload Now</option>
  </select>
  <input type="text" name="s" class="form-control" placeholder="Enter Model Number">
  <button class="btn btn-outline-secondary" type="submit">Scrape Now</button>
</div>
</form>
</center>
<?php

require 'tool/simple_html_dom.php';

// $html = file_get_html('http://www.google.com/');
// $title = $html->find('title', 0);
// $image = $html->find('img', 0);

// echo $title->plaintext."<br>\n";
// echo $image->src;

$scrape_from= array(
    'easyappliance'=> "https://www.easyapplianceparts.ca/Search.ashx?SearchTerm=[SEARCH]&SearchMethod=standard",
    'reliablepart'=> "https://www.reliableparts.ca/search?q=[SEARCH]",
    'partsselect'=> "https://www.partselect.ca/Models/[SEARCH]/?SourceCode=11",
    'atlanticappliance'=> "https://www.zohoinventory?q=[SEARCH]",
);


if(isset($_GET["s"])){
    
    // $search="36361222101";
    $search=$_GET["s"];

foreach ($scrape_from as $scrape_site => $url) {

        $scrapeURL=str_replace("[SEARCH]",$search,$url);
        $html = file_get_html($scrapeURL);
            switch($scrape_site){
                case "easyappliance":
                    $model_title=$html->find('h1.standard-blue-title',0)->plaintext;
                    
                    echo "<div style='margin-left:10%'>
                    <h6>Scrapped From: $scrapeURL </h6>";

                    /* First Mode for Easy Appliance Website */
                    if($html->find('div.seo-item.js-ua-km-partrow')){
                        echo "<h3 class='text-primary'>$model_title</h3>";
                        echo "</div>";

                        echo "<table class='table table-responsive table-bordered mx-auto' style='max-width:80%;border-color:black'>";
                        echo "<tr class='bg-dark text-light'>
                                <td>Image</td>
                                <td>Title & Description</td>
                                <td>Scrapred Price</td>
                                <td>30% Off Price</td>
                        ";
                            foreach($html->find('div.js-ua-km-partrow') as $part) {
                                $item['title'] =$item_title    = $part->find('div.seo-desc h3', 0)->plaintext;
                                $item['price'] =$item_price     = $part->find('p.nf-value strong', 0);
                                $item['description'] =$item_desc    = $part->find('p.copy-text', 0)->plaintext;
                                $item['img'] =$item_img = $part->find('img.seo-part-image', 0)->src;
                                $partList[] = $item;
    
                                // take 30 % off
                                $item_price_percent=$item_price;
                                if(!empty($item_price)){
                                    $explode = explode('$', $item_price);
                                    $item_price = (int) $explode[1];
                                    $item_price_percent=(int) $item_price - ($item_price*0.3);
                                }

                                echo "<tr>";
                                echo "<td> <img src='$item_img' height='100px' /></td>";
                                echo "<td> <h3>$item_title</h3>
                                        <p>$item_desc</p>
                                    </td>";
                                echo "<td><strong> $item_price</strong></td>";
                                echo "<td> <b style='color:green'>$item_price_percent</b></td>";
                                echo "</tr>";
                            }
    
                        echo "</table>";
                    } 
                    /* Second Mode for Easy Appliance Website */
                    elseif (!empty($html->find('span.copy-text.bottom-buffer'))) {
                        echo "<h3 class='text-primary'>$model_title</h3>";
                        echo "</div>";
                        

                        echo "<table class='table table-responsive table-bordered mx-auto' style='max-width:80%;border-color:black'>";
                        echo "<tr class='bg-dark text-light'>
                                <td>Image</td>
                                <td>Title & Description</td>
                                <td>Scrapred Price</td>
                                <td>30% Off Price</td>
                        ";
                            foreach($html->find('ul.popular-parts__parts-list li') as $part) {
                                $item['title'] =$item_title    = $part->find('h3.part-name', 0)->plaintext;
                                $dollar = $part->find('div.price-details div.price-details__price div.price span.dollar', 0)->plaintext;
                                $cents = $part->find('div.price-details div.price-details__price div.price span.cents', 0)->plaintext;
                                $item_price = $dollar.$cents;
                                $item['price'] =$item_price;
                                $item['description'] =$item_desc    = $part->find('div.part-desc', 0)->plaintext;
                                $item['img'] = $item_img = $part->find('a.part-photo img', 0)->src;
                                $partList[] = $item;
    
                                // take 30 % off
                                $item_price_percent=$item_price;
                                if(!empty($item_price)){
                                    (int) $item_price=str_replace("$","",$item_price);
                                    $item_price_percent=$item_price - ($item_price*0.3);
                                }
                                echo "<tr>";
                                echo "<td> <img src='$item_img' height='100px' /></td>";
                                echo "<td> <h3>$item_title</h3>
                                        <p>$item_desc</p>
                                    </td>";
                                echo "<td><strong> $item_price</strong></td>";
                                echo "<td> <b style='color:green'>$item_price_percent</b></td>";
                                echo "</tr>";
                            }
    
                        echo "</table>";
                    }
                    /* Third Mode for Easy Appliance Website */
                    elseif (!empty($html->find('div.part-info-wrap'))) {
                        echo "<h3 class='text-primary'>Search result for: ". $search ." </h3>";
                        echo "</div>";
                        

                        echo "<table class='table table-responsive table-bordered mx-auto' style='max-width:80%;border-color:black'>";
                        echo "<tr class='bg-dark text-light'>
                                <td>Image</td>
                                <td>Title & Description</td>
                                <td>Scrapred Price</td>
                                <td>30% Off Price</td>
                        ";
                            foreach($html->find('div.part-info-wrap') as $part) {
                                $item['title'] =$item_title    = $part->find('h1.standard-blue-title', 0)->plaintext;
                                $item['price'] = $item_price = $part->find('div.total-price', 0)->plaintext;
                                $item['description'] =$item_desc    = $part->find('div.part-details', 0)->plaintext;
                                $item['img'] = $item_img = "";
                                $partList[] = $item;
    
                                // take 30 % off
                                $item_price_percent=$item_price;
                                if(!empty($item_price)){
                                    (int) $item_price=str_replace("$","",$item_price);
                                    $item_price_percent=$item_price - ($item_price*0.3);
                                }
                                echo "<tr>";
                                echo "<td> <img src='$item_img' height='100px' /></td>";
                                echo "<td> <h3>$item_title</h3>
                                        <p>$item_desc</p>
                                    </td>";
                                echo "<td><strong> $item_price</strong></td>";
                                echo "<td> <b style='color:green'>$item_price_percent</b></td>";
                                echo "</tr>";
                            }
    
                        echo "</table>";
                    }
                    
                    else{
                        echo "<div style='margin-left:10%'>
                        <h3 class='text-danger'>No Result Found on $scrape_site for $search</h3>";
                    }

                        break;
                    case "reliablepart":
                        @$model_title=$html->find('h1#mainHeading', 0)->plaintext;
                        echo "<div style='margin-left:10%'>
                            <h6>Scrapped From: $scrapeURL </h6>";
                            if(strpos($html->plaintext,"No Results Found") !=true){
                                echo "<h3 class='text-primary'>$model_title</h3>
                                ";
                            }else{
                                echo "<h3 class='text-danger'>No Result Found on $scrape_site for $search</h3>";
                            }
                            echo "</div>";

                        // start table
                        echo "<table class='table table-responsive table-bordered mx-auto' style='max-width:80%;border-color:black'>";
                        echo "<tr class='bg-dark text-light'>
                                <td>Image</td>
                                <td>Title & Description</td>
                                <td>Scrapred Price</td>
                                <td>30% Off Price</td>
                        ";
                        
                        foreach($html->find('div.product-box-4col') as $part) {
                            $item['title'] =$item_title    = $part->find('a.productName', 0)->plaintext;
                            $part->find('div.product-price', 0)->children(0)->innertext = "";
                            $item['price'] =$item_price     = $part->find('div.product-price', 0)->plaintext;
                            $item['description'] =$item_desc    = $part->find('div.item-details', 0)->plaintext;
                            $item['img'] =$item_img =explode(')', explode('(',$part->find('div.product-image a', 0)->style)[1])[0] ;
                            
                            $partList[] = $item;
                            
                            // take 30 % off
                            $item_price_percent=$item_price;
                            if(!empty($item_price)){
                                (int) $item_price=str_replace("$","",$item_price);
                                $item_price_percent=$item_price - ($item_price*0.3);
                            }
                            echo "<tr>";
                            echo "<td> <img src='$item_img' height='100px' /></td>";
                            echo "<td> <h3>$item_title</h3>
                                    <p>$item_desc</p>
                                </td>";
                            echo "<td><strong> $item_price</strong></td>";
                            echo "<td> <b style='color:green'>$item_price_percent</b></td>";
                            echo "</tr>";
                        }

                        echo "</table>";

                        break;
                        case "partsselect":
                            @$model_title=$html->find('h1.title-main', 0)->plaintext;
                            echo "<div style='margin-left:10%'>
                                <h6>Scrapped From: $scrapeURL </h6>";
                                if(strpos($html->plaintext,"No Results Found") !=true){
                                    echo "<h3 class='text-primary'>$model_title</h3>
                                    ";
                                }else{
                                    echo "<h3 class='text-danger'>No Result Found on $scrape_site for $search</h3>";
                                }
                                echo "</div>";
    
                            // start table
                            echo "<table class='table table-responsive table-bordered mx-auto' style='max-width:80%;border-color:black'>";
                            echo "<tr class='bg-dark text-light'>
                                    <td>Image</td>
                                    <td>Title & Description</td>
                                    <td>Scrapred Price</td>
                                    <td>30% Off Price</td>
                            ";
                            
                            foreach($html->find('div.mega-m__part') as $part) {
                                $item['title'] =$item_title    = $part->find('a.mega-m__part__name', 0)->plaintext;
                                $item['price'] =$item_price     = $part->find('div.mega-m__part__price', 0);
                                ($item_price)?$item['price'] = $item_price = $item_price->plaintext:"";
                                $str = $part->find('div.d-flex.flex-col', 0);
                                foreach ($str->children as $child) {
                                    $child->innertext="";
                                }
                                
                                $str = $str->plaintext;
                                $item['description'] =$item_desc    = $str;
                                $item['img'] =$item_img = $part->find('a.mega-m__part__img img', 0)->getAttribute('data-src');
                                $partList[] = $item;

                                // take 30 % off
                                $item_price_percent=$item_price;
                                if(!empty($item_price)){
                                    (int) $item_price=str_replace("$","",$item_price);
                                    $item_price_percent=(int) $item_price - ($item_price*0.3);
                                }
                                echo "<tr>";
                                echo "<td> <img src='$item_img' height='100px' /></td>";
                                echo "<td> <h3>$item_title</h3>
                                        <p>$item_desc</p>
                                    </td>";
                                echo "<td><strong> $item_price</strong></td>";
                                echo "<td> <b style='color:green'>$item_price_percent</b></td>";
                                echo "</tr>";
                            }
    
                            echo "</table>";
    
                            break;
                    }
}

}

// echo $html = file_get_html('https://www.partselect.ca/Appliance-Parts.htm?source=gaws&gclid=EAIaIQobChMI_oXunYfT9QIVXfbjBx3eJQdHEAAYASAAEgLG7vD_BwE')->plaintext;

// Find all article blocks
// foreach($html->find('div.article') as $article) {
//     $item['title']     = $article->find('div.title', 0)->plaintext;
//     $item['intro']    = $article->find('div.intro', 0)->plaintext;
//     $item['details'] = $article->find('div.details', 0)->plaintext;
//     $articles[] = $item;
// }

// print_r($partList);

?>

</body>
</html>