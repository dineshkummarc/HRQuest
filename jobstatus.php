<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Job Status</title>
    <link rel="stylesheet" href="appliedJob.css">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div id="container">
    <h2>Job Status</h2>
    <table>
        <thead>
        <tr>
            <th>Job Title</th>
            <th>Applicant Name</th>
            <th>Status</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require 'database.php';
        
        // Start session (assuming session has already been started)
        session_start();
        
        // Check if user is logged in
        if(isset($_SESSION['email']) || isset($_SESSION['username'])) {
            // Retrieve user's email or username from session
            $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            

            $sql = "SELECT aj.jobtitle, aj.firstname, aj.lastname, j.id
                    FROM appliedjobs aj
                    INNER JOIN users u ON aj.email = u.email
                    INNER JOIN jobs j ON aj.jobtitle = j.job_title
                    WHERE u.email = '$userEmail' OR u.username = '$username'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["jobtitle"] . "</td>";
                    echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
                    echo "<td>" . 'Pending' . "</td>";
                    echo "<td><a href='userJobDetail.php?id=" . $row['id'] . "'>See More</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No applied jobs found</td></tr>";
            }
        } 
        else {
            echo "<p>Please <a href='login.php'>log in</a> to view applied jobs<p>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
