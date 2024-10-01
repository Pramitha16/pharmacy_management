<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
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
            
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Address</th>
            <th>Phone No</th>
            <th>Salary</th>
            
        </tr>
        <?php
        $con = new mysqli("localhost","root","123456789","pharmacy_management");
        $sql = "SELECT * from employee_details";
        $result = $con-> query($sql);
        if($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()) {
                echo "<tr><td>".$row["EMP_ID"]."</td><td>".$row["EMP_NAME"]."</td><td>".$row["ADDRESS"]."</td><td>".$row["PHONE_NO"]."</td><td>".$row["SALARY"]."</td></tr>";
            }
            echo "</table>";
        }
        $con-> close();
        ?>
    </table>
</body>
</html>