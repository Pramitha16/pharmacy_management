<?php

$name = $_POST['name'];
$qty = $_POST['qty'];
$pur = $_POST['pur'];
$sell = $_POST['sell'];
$mdate = $_POST['mdate'];
$edate = $_POST['edate'];



$con = new mysqli("localhost","root","123456789","pharmacy_management");

$s = "select * from inventory where PROD_NAME='$name'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
     $update = "update inventory SET QTY=QTY+$qty, MFG_DATE='$mdate', EXP_DATE='$edate',PUR_RATE='$pur',SELL_RATE='$sell' where PROD_NAME='$name'";
     mysqli_query($con, $update);
     echo '<script type ="text/JavaScript">';  
    echo 'alert("Product Updated Successfully")';  
    echo '</script>';

}else{

$reg= "insert into inventory(PROD_NAME,QTY,MFG_DATE,EXP_DATE,PUR_RATE,SELL_RATE) values ('$name' , '$qty', '$mdate', '$edate', '$pur', '$sell')";
    mysqli_query($con, $reg);
    echo '<script type ="text/JavaScript">';  
    echo 'alert("Product Added Successfully")';  
    echo '</script>'; 
}
?>
<meta http-equiv="refresh" content="0;url=addprod.html"/>