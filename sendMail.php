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
    <title>Send Email</title>
    <link rel="stylesheet" href="appliedJob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div id="container">
<div class="goback">
        <a href="adminDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
    <h2>Send Email to <span style='color: green;'>Accepted</span> Candidate</h2>
    <table>
        <thead>
        <tr>
            <th>Applicant Name</th>
            <th>Applicant Email</th>
            <th>Applicant Job Title</th>
            <th>Send Email</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        require 'database.php';
        $sql = "SELECT * FROM accepted";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Variable to store all email addresses
            $emailList = array();
            
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["firstname"] . " " . $row['lastname'] . "</td>";
                echo "<td>" . $row["email"]. "</td>";
                echo "<td>" . $row["jobtitle"] . "</td>";
                echo "<td><a href='mailto:" . $row["email"] . "'>Mail to " . $row['firstname'] ."</a></td>"; 
                echo "</tr>";
                
                // Collect email addresses
                $emailList[] = $row["email"];
            }

            //filtering out unique emails
            $uniqueEmails = array_unique($emailList);
            
            // Construct mailto link with all email addresses
            $emailAddresses = implode(",", $uniqueEmails);
            echo "<tr style='background:#DADBF1;'>";
            echo "<td colspan='3'><b>Send Email to All Applicants</b></td>";
            echo "<td><a href='mailto:$emailAddresses'><b>Mail to Everyone</b></a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<div id="container">
    <h2>Send Email to <span style='color: red;'>Rejected</span> Candidate</h2>
    <table>
        <thead>
        <tr>
            <th>Applicant Name</th>
            <th>Applicant Email</th>
            <th>Applicant Job Title</th>
            <th>Send Email</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        require 'database.php';
        $sql = "SELECT * FROM rejected";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Variable to store all email addresses
            $emailList = array();
            
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["firstname"] . " " . $row['lastname'] . "</td>";
                echo "<td>" . $row["email"]. "</td>";
                echo "<td>" . $row["jobtitle"] . "</td>";
                echo "<td><a href='mailto:" . $row["email"] . "'>Mail to " . $row['firstname'] ."</a></td>"; 
                echo "</tr>";
                
                // Collect email addresses
                $emailList[] = $row["email"];
            }
            $uniqueEmails = array_unique($emailList);
            
            // Construct mailto link with all email addresses
            $emailAddresses = implode(",", $uniqueEmails);
            echo "<tr style='background:#DADBF1;'>";
            echo "<td colspan='3'><b>Send Email to All Applicants</b></td>";
            echo "<td><a href='mailto:$emailAddresses'><b>Mail to Everyone</b></a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
