<?php include_once "config.php"; ?>
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
// $pending = 0;
// $proccessed = 0;
// $sql1 = mysqli_query($connection, "SELECT * FROM scraped");
// if (mysqli_num_rows($sql1) > 0) {
//     while($row = $sql1->fetch_assoc()) {
//         if ($row['status'] == '1') {
//             $pending++;
//         }
//         if ($row['status'] == '3') {
//             $proccessed++;
//         }
    
//     }
   
// }
$query = "SELECT * FROM scraped ORDER BY id DESC";
$sql = mysqli_query($connection, $query);
if (mysqli_num_rows($sql) > 0) {
    
        
?>
<center>
<h1> Atlantic Appliance Scraper Tool </h1>
<p>This tool will scrape and upload parts to Zoho Inventory -> Amazon</p>
<?php 
// echo '<h3>Total pending queue: ' .$pending. '</h3>';
// echo '<h3>Total proccessed queue: ' .$proccessed. '</h3>';
?>
</center>

<table class="table table-responsive table-bordered mt-5  mx-auto
" style='max-width:80%;border-color:black'>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Title</th>
            <th>Model Number</th>
            <th>part Number</th>
            <th>Description</th>
            <th>Price</th>
            <th>Discounted Price</th>
            <th>status</th>
            <th>Image Link</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        while($row = $sql->fetch_assoc()) {

        ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['model_no'] ?></td>
            <td><?= $row['part_no'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['discounted_price'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['image'] ?></td>
        </tr>
       
        <?php  
            $id++;
            } 
        }
        ?>
    </tbody>
</table>