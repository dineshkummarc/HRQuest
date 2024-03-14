<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applicant Details</title>
    <link rel="stylesheet" href="appliedJob.css">
</head>
<body>
    <?php require 'database.php';

    // Get the applicant ID from the URL parameter
    $applicant_id = $_GET['id'];

    // Fetch applicant details from the database based on the ID
    $sql = "SELECT * FROM appliedJobs WHERE id = $applicant_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display applicant details
        $row = $result->fetch_assoc();
        echo "<div id='containersecond'>";
        echo "<h2>Applicant Details</h2>";
        echo "<p>Applied Position: " . $row['jobtitle'] . "</p>";
        echo "<p>Applicant Name: " . $row["firstname"] . " " . $row["lastname"] . "</p>";
        echo "<p>Email: " . $row["email"] . "</p>";
        echo "<p>Phone Number: " . $row["contact"] . "</p>";
        echo "<p>Location: " . $row["location"] . "</p>";
        echo "<button class='download-button btn download'><a style='color: #fff;' href='" . $row["resume_path"] . "' download>Download CV</a></button>";
        echo "</div>";
        // Add more details as needed
    } else {
        echo "Applicant not found";
    }
    ?>
</body>
</html>
