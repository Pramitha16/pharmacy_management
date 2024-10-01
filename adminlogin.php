

<?php

$email = $_POST['name'];
$password = $_POST['password'];

$con = new mysqli("localhost","root","123456789","pharmacy_management");
if($con->connect_error){
    die("Failed to connect : ".$con->connect_error);
} else{
     $s = "CALL proc1('$email','$password')";
    $result = mysqli_query($con, $s);
    $num = mysqli_num_rows($result);
    if($num >= 1){

        echo '<script type ="text/JavaScript">';
        echo 'alert("Login Successfull !")';
        echo '</script>';

        header('location:admindashboardnew.html');
    }else {
        echo '<script type ="text/JavaScript">';
        echo 'alert("Incorrect Email or Password")';
        echo '</script>';
    }
    }
?>

<meta http-equiv="refresh" content="0;url=adminlogin.html"/>