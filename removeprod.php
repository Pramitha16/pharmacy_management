<?php

$name = $_POST['name'];
$edate = $_POST['edate'];

$con = new mysqli("localhost","root","123456789","pharmacy_management");

$s = "select * from inventory where PROD_NAME = '$name' && EXP_DATE = '$edate'";
$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 0){
    
     echo '<script type ="text/JavaScript">';  
     echo 'alert("Product Does not Exists")';  
     echo '</script>'; 
    ?>
    <meta http-equiv="refresh" content="0;url=removeprod.html"/>
    <?php
}else{
$del= "DELETE FROM inventory where PROD_NAME='$name' && EXP_DATE='$edate'";
    mysqli_query($con, $del);
    echo '<script type ="text/JavaScript">';  
    echo 'alert("Product Removed Successfully")';  
    echo '</script>'; 
}
?>
<meta http-equiv="refresh" content="0;url=removeprod.html"/>