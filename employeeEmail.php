<?php
session_start();

if(!isset($_SESSION['employee_username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Send Email</title>
    <link rel="stylesheet" href="appliedJob.css">
</head>
<body>
<div id="container">
    <h2>Send Email to Manager</h2>
    <table>
        <thead>
        <tr>
            <th>Manager Name</th>
            <th>Manager Email</th>
            <th>Send Email</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        require 'database.php';
        $sql = "SELECT * FROM manager";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $emailList = array();
            
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["m_username"] . "</td>";
                echo "<td>" . $row["m_email"]. "</td>";
                echo "<td><a href='mailto:" . $row["m_email"] . "'>Mail to " . $row['m_username'] ."</a></td>"; 
                echo "</tr>";
            
            }
            
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
