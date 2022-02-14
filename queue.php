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
$pending = 0;
$proccessed = 0;
$sql1 = mysqli_query($connection, "SELECT * FROM queue");
if (mysqli_num_rows($sql1) > 0) {
    while($row = $sql1->fetch_assoc()) {
        if ($row['status'] == '1') {
            $pending++;
        }
        if ($row['status'] == '3') {
            $proccessed++;
        }
    
    }
   
}
$query = "SELECT * FROM queue ORDER BY id DESC";
$sql = mysqli_query($connection, $query);
if (mysqli_num_rows($sql) > 0) {
    
        
?>
<center>
<h1> Atlantic Appliance Scraper Tool </h1>
<p>This tool will scrape and upload parts to Zoho Inventory -> Amazon</p>
<?php 
echo '<h3>Total pending queue: ' .$pending. '</h3>';
echo '<h3>Total proccessed queue: ' .$proccessed. '</h3>';
?>
</center>

<table class="table table-responsive table-bordered mt-5  mx-auto
" style='max-width:80%;border-color:black'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Model</th>
            <th>status</th>
            <th>Date</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $id = 1;
        while($row = $sql->fetch_assoc()) {
            if ($row['status'] == '1') {
                $status = "Pending";
                $pending++;
            } elseif ($row['status'] == '2') {
                $status = "Processing";
            } else{
                $status = "Proccessed";
            }

        ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $row['data']; ?></td>
            <td><?= $status ?></td>
            <td><?= $row['created'] ?></td>
        </tr>
       
        <?php  
            $id++;
            } 
        }
        ?>
    </tbody>
</table>