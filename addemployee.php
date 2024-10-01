<?php

$name = $_POST['Name'];
$ph = $_POST['Ph'];
$address = $_POST['add'];
$sal = $_POST['sal'];
$pass = $_POST['password'];

$con = new mysqli("localhost","root","123456789","pharmacy_management");
$s = "select * from employee_details where EMP_NAME='$name' && PHONE_NO='$ph' && ADDRESS='$address' && SALARY='$sal' ";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
     echo '<script type ="text/JavaScript">';  
     echo 'alert("Employee already exists")';  
     echo '</script>'; 
}else{

$reg= "insert into employee_details(EMP_NAME,PHONE_NO,ADDRESS,SALARY,PASSWORD) values ('$name' , '$ph', '$address', '$sal', '$pass')";
    mysqli_query($con, $reg);
    echo '<script type ="text/JavaScript">';  
    echo 'alert("Employee Added Successfully")';  
    echo '</script>'; 
}
?>
<meta http-equiv="refresh" content="0;url=addemployee.html"/>