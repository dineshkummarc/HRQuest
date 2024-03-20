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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div id="container">
<div class="goback">
        <a href="employeeDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
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
            
                // $emailList[] = $row["e_email"];
            }
            
            // $emailAddresses = implode(",", $emailList);
            // echo "<tr style='background:#DADBF1;'>";
            // echo "<td colspan='3'><b>Send Email to All Employees</b></td>";
            // echo "<td><a href='mailto:$emailAddresses'><b>Mail to Everyone</b></a></td>";
            // echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
