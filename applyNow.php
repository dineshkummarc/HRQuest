<?php
include 'database.php';

session_start(); // Start session if not already started

$job_id = $_GET['id']; 

$result = mysqli_query($conn, "SELECT job_title FROM jobs WHERE id = $job_id");

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $job_title = $row['job_title'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target_dir = "uploads/resume/";
        $target_file = $target_dir . basename($_FILES["resume"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($_FILES["resume"]["size"] > 10000000) { // 10MB limit, adjust as needed
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        $allowedExtensions = array("pdf", "doc", "docx", "txt"); // Add more if needed
        if (!in_array($fileType, $allowedExtensions)) {
            echo "Sorry, only PDF, DOC, DOCX, and TXT files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["resume"]["name"])). " has been uploaded.";
                
                // Fetch username from session
                $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

                // Retrieve other form data
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $contact = $_POST['contact'];
                $location = $_POST['location'];

                // Insert data into appliedjobs table
                mysqli_query($conn, "INSERT INTO appliedjobs (firstname, lastname, email, contact, location, resume_path, jobtitle, username) VALUES ('$firstname', '$lastname', '$email', '$contact', '$location', '$target_file', '$job_title', '$username')");
                header("Location: userCareer.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
} else {
    echo "Job not found or invalid job ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Apply Now</title>
    <link rel="stylesheet" href="jobpost.css">
</head>
<body>
    
<div id="container">
    <?php
    include 'database.php';
    $job_id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM jobs WHERE id = $job_id");
    $row = mysqli_fetch_assoc($result);
    echo "<h2 style='text-align: center;'>Apply for " . $row['job_title'] . "</h2>";
    ?>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="showConfirmation()">
        <div class="field-input">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" required>
        </div>
        <div class="field-input">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        <div class="field-input">
            <label for="email">Email (Must be same as user email)</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="field-input">
            <label for="contact">Phone Number</label>
            <input type="text" name="contact" id="contact" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57" autocomplete="off" required>
        </div>
        <div class="field-input">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>
        </div>
        <div class="field-input">
            <label for="resume">Upload your resume: (Max 10 MB)</label><br>
            <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" required><br><br>
        </div>
        <div class="field-input">
            <button type="submit">Apply</button>
        </div>            
    </form>     
</div>

<script>
    function showConfirmation() {
        alert("Thanks for applying!");
    }
</script>
</body>
</html>
