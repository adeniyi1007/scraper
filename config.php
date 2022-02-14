<?php
$connection = mysqli_connect('localhost', 'educhwcc_scper', 'paper_lantern', 'educhwcc_scper');
// $connection = mysqli_connect('localhost', 'root', '', 'scraper');
if (!$connection) {
    echo "Database not connected: " . mysqli_connect_error();
}