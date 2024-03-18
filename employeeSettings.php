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
    <meta charset="utf-8">
    <title>Job Status</title>
    <link rel="stylesheet" href="appliedJob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="goback">
        <a href="employeeDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
<div id="container">
    <h2>Personal Details</h2>
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Job Title</th>
            <th>Change your password</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require 'database.php';


// Check if user is logged in
if(isset($_SESSION['email']) || isset($_SESSION['username'])) {
    // Retrieve user's email or username from session
    $employeeEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $employeeUsername = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    
    $sql = "Select * from employee where e_email = '$employeeEmail' OR e_username = '$employeeUsername'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["e_username"] . "</td>";
            echo "<td>" . $row["e_email"]  . "</td>";
            echo "<td>" . $row["e_jobtitle"]  . "</td>";
            echo "<td><a href='empChangePassword.php'><button class='btn'>Change Password</button></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No employee found.</td></tr>";
    }
} 
else {
    echo "<p>Please <a href='login.php'>log in</a> to view this page.<p>";
}
?>

        </tbody>
    </table>
</div>

</body>
</html>
