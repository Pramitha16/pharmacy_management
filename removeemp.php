<?php

$id = $_POST['id'];

$con = new mysqli("localhost","root","123456789","pharmacy_management");
$s = "select * from employee_details where EMP_ID = '$id'";
$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 0){
    
     echo '<script type ="text/JavaScript">';  
     echo 'alert("Employee Does not Exists")';  
     echo '</script>'; 
    ?>
    <meta http-equiv="refresh" content="0;url=removeemployee.html"/>
    <?php
}else{
$del= "DELETE FROM employee_details WHERE EMP_ID = '$id'";
    mysqli_query($con, $del);
    echo '<script type ="text/JavaScript">';  
    echo 'alert("Employee Removed Successfully")';  
    echo '</script>'; 
}
?>
<meta http-equiv="refresh" content="0;url=removeemp.html"/>