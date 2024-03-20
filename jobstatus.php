<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Job Status</title>
    <link rel="stylesheet" href="appliedJob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div id="container">
<div class="goback">
        <a href="userDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
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
    
    $sql = "SELECT aj.jobtitle, aj.firstname, aj.lastname, j.id, 'Pending' AS status
    FROM appliedjobs aj
    INNER JOIN users u ON aj.email = u.email
    INNER JOIN jobs j ON aj.jobtitle = j.job_title
    WHERE u.email = '$userEmail' OR u.username = '$username'
    
    UNION
    
    SELECT r.jobtitle, r.firstname, r.lastname, j.id, 'Rejected' AS status
    FROM rejected r
    INNER JOIN users u ON r.email = u.email
    INNER JOIN jobs j ON r.jobtitle = j.job_title
    WHERE u.email = '$userEmail' OR u.username = '$username'
    
    UNION
    
    SELECT ac.jobtitle, ac.firstname, ac.lastname, j.id, 'Accepted' AS status
    FROM accepted ac
    INNER JOIN users u ON ac.email = u.email
    INNER JOIN jobs j ON ac.jobtitle = j.job_title
    WHERE u.email = '$userEmail' OR u.username = '$username'
    ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["jobtitle"] . "</td>";
            echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
            $status_class = '';
            if ($row["status"] === 'Accepted') {
                $status_class = 'accepted';
            } elseif ($row["status"] === 'Rejected') {
                $status_class = 'rejected';
            }
            echo "<td class='$status_class'>" . $row["status"] . "</td>";
            echo "<td><a href='userJobDetail.php?id=" . $row['id'] . "'>See More</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No applied jobs found</td></tr>";
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
