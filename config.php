<?php
$connection = mysqli_connect('localhost', 'root', '', 'scraper');
if (!$connection) {
    echo "Database not connected: " . mysqli_connect_error();
}