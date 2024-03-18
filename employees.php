<?php
session_start();

if(!isset($_SESSION['admin_username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Employee Details</title>
    <link rel="stylesheet" href="appliedJob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div id="container">
<div class="goback">
        <a href="adminDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
    <h2>Employee Details</h2>
    <table>
        <thead>
        <tr>
            <th>Employee Name</th>
            <th>Employee Email</th>
            <th>Employee Job Title</th>
            <th>Send Email</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        require 'database.php';
        $sql = "SELECT * FROM employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Variable to store all email addresses
            $emailList = array();
            
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["e_username"] . "</td>";
                echo "<td>" . $row["e_email"]. "</td>";
                echo "<td>" . $row["e_jobtitle"] . "</td>";
                echo "<td><a href='mailto:" . $row["e_email"] . "'>Mail to " . $row['e_username'] ."</a></td>"; 
                echo "</tr>";
                
                // Collect email addresses
                $emailList[] = $row["e_email"];
            }
            
            // Construct mailto link with all email addresses
            $emailAddresses = implode(",", $emailList);
            echo "<tr style='background:#DADBF1;'>";
            echo "<td colspan='3'><b>Send Email to All Employees</b></td>";
            echo "<td><a href='mailto:$emailAddresses'><b>Mail to Everyone</b></a></td>";
            echo "</tr>";
            echo "<tr style='background:#DADBF1;'>";
            echo "<td colspan='3'><b>Register New Employee</b></td>";
            echo "<td><a href='registerEmployee.php'><b>Register Now</b></a></td>";
            echo "</tr>";            
            
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
