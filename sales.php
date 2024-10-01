
 <head>
   <title>SALES</title>
 <link rel="icon" href="logo.jpg">
      <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled Bootstrap JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </head>
<div class="pt-5">  
<button  style="background-color: whitesmoke;" id="add" class="btn btn-primary" type="submit"><a href="bill.php" >Add Billings</a></button>
  <h1 class="text-center">Read   bill </h1>  
<div class="container">  
                <div class="row">  
                    <div class="col-md-5 mx-auto">  
                        <div class="card card-body">  
                      <form id="submitForm" action="sales.php" method="post" data-parsley-validate="" data-parsley-errors-messages-disabled="true" novalidate="" _lpchecked="1">  
                 
                      <div class="form-group required">  
              <lSabel for="student_id"> bill no </lSabel>  
             <input type="number" class="form-control text-lowercase" id="student_id" required="" name="search" value="">  
               </div>   
              
         <div class="form-group pt-1">  
      <button class="btn btn-primary btn-block" name="read" type="submit"> Read </button>  
                  </div>  
                  
               </form>                
                       </div>  
                    </div>  
                </div>  
            </div>  
</div>  
<br>


  <?php
$con = new mysqli("localhost","root","123456789","pharmacy_management");
  if(isset($_POST['read'])){
   include("db.php");
    $search_value=$_POST['search'];
    $query="select * from billing where bill_invoice like '%$search_value%'";
    $query1="select sum(total) as grand_tot from billing  where bill_invoice like '%$search_value%' group by bill_invoice";
  $result= mysqli_query($con, $query);
  $result1= mysqli_query($con, $query1);
  $row1=mysqli_fetch_array($result1);
  ?>
  <h1>Grand total:<?php echo $row1['grand_tot'];?></h1>
  <table class="table">
	<thead>
		<tr>
			<th> bill no </th>
			<th> drug_name </th>
			<th> quantity</th>
            <th> price </th>
			<th> total </th>
		

		</tr>
	</thead> 
  <?php
   while($row=mysqli_fetch_array($result)){
     ?>
     	<tbody>
		<tr>
   
     			<td> <?php echo $row['bill_invoice']; ?> </td>
			<td> <?php echo $row['drug_name']; ?></td>
         <td> <?php echo $row['quantity']; ?></td>
         <td> <?php echo $row['price']; ?></td>
         <td> <?php echo $row['total']; ?></td>
         

			
		</tr> 
		
   
    <?php
   }
    }
      ?>  
   
   
   
   
   
    
   
	</tbody>
</table>

