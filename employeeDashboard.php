<?php
session_start();

// Check if any user is logged in, if not, redirect to login page
if(!isset($_SESSION['employee_username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
  </head>
   <body>
   <div id="container">
    
   
   <div id="body">
        Human Resources Management System - Employee
        </div>
        <div id="header">
            <a href="emp_attendance.php">Attendance</a>
            <a href="employee_payroll.php">Invoice</a>
            <a href="employeeEmail.php">Send Email</a>
            <a href="employeeSettings.php">Settings</a>
            <a href="logout.php">Logout</a>
        </div>
        </div>
    </body>
   

</html>