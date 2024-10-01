<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_no = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $password = $_POST['password']; // We'll hash this before using

    $con = new mysqli("localhost", "root", "123456789", "pharmacy_management");
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        // Set the connection character set to utf8mb4
        $con->set_charset("utf8mb4");
        
        // Instead of calling the stored procedure, let's write out the query
        // and explicitly set the collation for the comparison
        $query = "SELECT * FROM employee_details WHERE phone_no = ? COLLATE utf8mb4_general_ci AND password = ? COLLATE utf8mb4_general_ci";
        
        $stmt = $con->prepare($query);
        
        if ($stmt === false) {
            // Handle prepare() error
            $response = ["success" => false, "message" => "Error preparing statement: " . $con->error];
        } else {
            $stmt->bind_param("ss", $phone_no, $password);
            
            try {
                if ($stmt->execute()) {
                    $result = $stmt->get_result();

                    if ($result->num_rows >= 1) {
                        echo '<script type="text/JavaScript">';
                        echo 'alert("Login Successful!")';
                        echo '</script>';

                        header('location:employeedashboard.html');
                    } else {
                        echo '<script type="text/JavaScript">';
                        echo 'alert("Incorrect Username or Password")';
                        echo '</script>';
                    }      
                } else {
                    throw new Exception($stmt->error);
                }
            } catch (Exception $e) {
                $response = ["success" => false, "message" => "Error in SQL query: " . $e->getMessage()];
                
                // Log the error for debugging
                error_log("SQL Error: " . $e->getMessage());
            }

            $stmt->close();
        }

        $con->close();

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>