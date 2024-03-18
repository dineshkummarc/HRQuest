<?php
session_start();

// Check if any user is logged in, if not, redirect to login page
if(!isset($_SESSION['user_username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
  </head>
   <body>
   <div id="container">
      <div id="body">
          Human Resources Management System - User
      </div>
      <div id="header">
          <a href="userDashboard.php">Home</a>
          <a href="userCareer.php">Apply Now</a>
          <a href="jobstatus.php">Job Status</a>
          <a href="userSettings.php">Settings</a>
          <a href="logout.php">Logout</a>
      </div>
    </div>
    </body>
   

</html>