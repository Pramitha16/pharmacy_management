<?php

$conn = mysqli_connect("localhost","root","123456789","pharmacy_management");
// check connection
if (mysqli_connect_errno()){
    echo "failed to connect to MySQL: " . mysqli_connect_errno();
    exit();
}
?>