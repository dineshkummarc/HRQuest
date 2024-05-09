<?php
session_start();

// Check if any user is logged in, if not, redirect to login page
if (!isset($_SESSION['employee_username'])) {
    header("Location: login.php");
    exit();
}
$e_username = $_SESSION['username'];
$e_email = $_SESSION['email'];

require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    date_default_timezone_set('Asia/Kathmandu');

    // Get the current time in Asia/Kathmandu timezone
    $currentTime = date("Y-m-d H:i:s");

    // Check if both check-in and check-out are recorded for today
    $sql_check_today = "SELECT * FROM attendance_records WHERE (e_username = '$e_username' OR e_email = '$e_email') AND DATE(check_in_time) = CURDATE() AND DATE(check_out_time) = CURDATE()";
    $result_check_today = $conn->query($sql_check_today);

    if ($result_check_today->num_rows > 0) {
        // Both check-in and check-out have already been performed today
        echo "<script>alert('You have already checked in and checked out today.')</script>";
    } else {
        // Check if only check-in is recorded for today
        $sql_check_in_today = "SELECT * FROM attendance_records WHERE (e_username = '$e_username' OR e_email = '$e_email') AND DATE(check_in_time) = CURDATE()";
        $result_check_in_today = $conn->query($sql_check_in_today);

        if ($status === "check_in" && $result_check_in_today->num_rows > 0) {
            // Check-in is already recorded for today
            echo "<script>alert('You have already checked in today.')</script>";
        } elseif ($status === "check_out" && $result_check_in_today->num_rows == 0) {
            // Check-in is not recorded for today
            echo "<script>alert('You have not checked in yet.')</script>";
        } else {
            // Proceed with recording check-in or check-out
            if($status === "check_in" || $status === "check_out") {
                $sql_employee = "SELECT * FROM employee WHERE e_username = '$e_username' OR e_email = 'e_email'";
                $result_employee = $conn->query($sql_employee);
            
                if ($result_employee->num_rows > 0) {
                    $row_employee = $result_employee->fetch_assoc();
                    $e_email = $row_employee['e_email'];
            
                    if ($status === "check_in") {
                        $sql = "INSERT INTO attendance_records (e_username, e_email, check_in_time) VALUES ('$e_username', '$e_email', '$currentTime')";
                    } elseif ($status === "check_out") {
                        $sql = "UPDATE attendance_records SET check_out_time = '$currentTime' WHERE (e_username = '$e_username' OR e_email = '$e_email') AND check_out_time IS NULL";
                    }
            
                    if ($conn->query($sql) === TRUE) {
                        echo"<script>alert('Recorded successfully.')</script>" ;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Error: Employee not found.";
                }
            } else {
                echo "Error: Invalid status.";
            }
        }
    } 

    $conn->close();
}
?>


 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Employee Attendance</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="goback">
        <a href="employeeDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
<div class="container-attendance">
    <form method="POST" action="">
        <h2>Do Your Attendance</h2>
        <button class="btn-attendance" type="submit" name="status" value="check_in">Check In</button>
        <button class="btn-attendance" type="submit" name="status" value="check_out">Check Out</button>
    </form>
</div>
</body>
</html>