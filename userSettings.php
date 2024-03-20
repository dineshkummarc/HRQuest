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
    <meta charset="utf-8">
    <title>Job Status</title>
    <link rel="stylesheet" href="appliedJob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="goback">
        <a href="userDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
<div id="container">
    <h2>Personal Details</h2>
    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Detail</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require 'database.php';


// Check if user is logged in
if(isset($_SESSION['email']) || isset($_SESSION['username'])) {
    // Retrieve user's email or username from session
    $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    
    $sql = "Select * from users where email = '$userEmail' OR username = '$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>Username</td>";
            echo "<td>" . $row["Username"] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Email</td>";
            echo "<td>" . $row["Email"]  . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Change your password</td>";
            echo "<td><a href='changepassword.php'><button class='btn'>Change Password</button></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No user found.</td></tr>";
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
