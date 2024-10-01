<?php 
   include("db.php");
    
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled Bootstrap JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <title>Billing</title>
      <style>
        .result{
         color:red;
        }
        td
        {
          text-align:center;
        }
      </style>
   </head>
   <body>
      <section class="mt-3">
         <div class="container-fluid">
         <h4 class="text-center" style="color:green"> MITK DRUG STORE </h4>
         <h6 class="text-center">BILLINGS </h6>
         <div class="row">
            <div class="col-md-5  mt-4 ">
               <table class="table" style="background-color:#f5f5f5;">
                  <thead>
                     <tr>

                     <th></th>

                        <th>Drug name</th>
                        <th style="width: 35%">Qty</th>
                        <th>bill no</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td scope="row"></td>
                        <td style="width:60%">
                           <form action="bill.php" method="POST">
                           <select name="drugname" id="vegitable"  class="form-control">
                              <?php 
                                 $sql = "SELECT * FROM inventory";
                                 $query = mysqli_query($conn,$sql);
                                 while($row = mysqli_fetch_assoc($query)){
                                 ?>
                              <option name="drugname"  id="" value="<?php echo $row['PROD_NAME']; ?>" class="vegitable custom-select">
                                 <?php echo $row['PROD_NAME']; ?>
                              </option>
                              <?php  }?>   
                           </select>
                           <td style="width:10%">
                          <input type="number" id="qty" min="0" value="0" class="form-control" name="quantity">
                        </td>
                      
                        <td style="width:10%">
                          <input style="width:100px" type="number" id="bill_no" min="0" value="4" class="form-control" name="bill_no">
                        </td>
                           <td><button name="insert" id="add" class="btn btn-primary" type="submit">Add</button></td>
                           </form>
                        </td>
                        
                        <!-- <td>
                        <input style="width:100px"type="number" id="qty" min="0" value=" " class="form-control">
                        </td> -->
                        <!-- <td><button id="add" class="btn btn-primary">Add</button></td> -->
                     </tr>
                  </tbody>
               </table>
               <button  style="background-color: whitesmoke;" id="add" class="btn btn-primary" type="submit"><a href="sales.php" >Read Billings</a></button>
                        
               <?php 
               $con = new mysqli("localhost","root","123456789","pharmacy_management");
               if(isset($_POST['insert'])){
               
               $billinvoice = $_POST["bill_no"];
               $drugname = $_POST["drugname"];
               $q = $_POST["quantity"];
               $query = "select SELL_RATE FROM inventory where PROD_NAME = '$drugname'";
               $res = mysqli_query($con, $query);
              $row= mysqli_fetch_assoc($res);
              $p = $row['SELL_RATE'];
               $t = $p*$_POST['quantity'];
               
               $s = "insert into billing(bill_invoice,drug_name,quantity,price,total) values($billinvoice,'$drugname',$q,$p,$t);";

              if(mysqli_query($con, $s)){
               echo '<script type ="text/JavaScript">';  
               echo 'alert("bill Added Successfully")';  
               echo '</script>';
              }else{
               echo '<script type ="text/JavaScript">';  
               echo 'alert("bill not Added Successfully")';  
               echo '</script>';
              }

               

               
               
               }
               ?> 

               <div role="alert" id="errorMsg" class="mt-5" >
                 <!-- Error msg  -->
              </div>
            </div>
           <!-- paste here -->
         </div>
      </section>






      <?php

?>




   </body>
</html>
