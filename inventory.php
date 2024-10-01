<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="icon" href="logo.jpg">
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
            color: rgb(76, 15, 247);
            font-family: monospace;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color: rgb(76, 15, 247);
            color: white; 
        }
        tr:nth-child(even) {background-color:  rgb(144, 144, 243)}
    </style>
</head>
<body>
    <table>
        <tr>
            
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Purchase Rate</th>
            <th>Sell Rate</th>
            <th>MFG Date</th>
            <th>EXP Date</th>
            
        </tr>
        <?php
        $con = new mysqli("localhost","root","123456789","pharmacy_management");
        $sql1="SELECT * FROM triggertotal";
        $result1=mysqli_query($con,$sql1);
        $row1 = mysqli_fetch_assoc($result1);
        
        ?>
        <h1 style="color: rgb(76, 15, 247);;">TOTAL MEDICINES IS:<?php echo $row1['total'];?>
        <?php



        $sql = "SELECT * from inventory";
        $result = $con-> query($sql);
        if($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()) {
                echo "<tr><td>".$row["PROD_NAME"]."</td><td>".$row["QTY"]."</td><td>".$row["PUR_RATE"]."</td><td>".$row["SELL_RATE"]."</td><td>",$row["MFG_DATE"],"</td><td>",$row["EXP_DATE"],"</td></tr>";
            }
            echo "</table>";
        }
        $con-> close();
        ?>
    </table>
</body>
</html>

