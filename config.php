<?php
$connection = mysqli_connect('blinkycollections.com', 'educhwcc_scper', 'paper_lantern', 'educhwcc_scper');
if (!$connection) {
    echo "Database not connected: " . mysqli_connect_error();
}