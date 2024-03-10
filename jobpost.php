<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            $job_title = $_POST['job_title'];
            $job_description = $_POST['job_description'];
            $location = $_POST['location'];
            $salary = $_POST['salary'];
            $skills = $_POST['skills'];
            $jobtype = $_POST['jobtype'];
            $education = $_POST['education'];
            $experience = $_POST['experience'];
            mysqli_query($conn, "INSERT INTO jobs (job_title, job_description, image_path, location, salary, skills, jobtype, education, experience) VALUES ('$job_title', '$job_description', '$target_file', '$location', '$salary', '$skills', '$jobtype', '$education', '$experience')");
            header("Location: jobpost.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Post Your Job</title>
    <link rel="stylesheet" href="jobpost.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    
      <div id="container">
          <h1>Job Post</h1>
          <div class="goback">
              <a href="adminDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
          </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="field-input">
                <label for="job_title">Job Title:</label>
                <input type="text" name="job_title" id="job_title" required>
                <label for="job_description">Job Description:</label>
                <textarea id="job_description" name="job_description" required></textarea>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image" accept="image/*" required><br><br>
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" required>
                <label for="salary">Salary:</label>
                <input type="text" name="salary" id="salary" required>
                <label for="skills">Enter 3 skills (comma-separated):</label>
                <input type="text" id="skills" name="skills" required><br>
                <label for="jobtype">Job Type:</label>
                <select id="jobtype" name="jobtype">
                    <option value="select" selected disabled>Choose Job Type</option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Contract">Contract</option>
                    <option value="Internship">Internship</option>
                </select>
                <label for="education">Education:</label>
                <select id="education" name="education">
                    <option value="select" selected disabled>Choose Education</option>
                    <option value="Master">Master</option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="High School">High School</option>
                    <option value="Not Required">Not Required</option>
                </select>
                <label for="experience">Experience:</label>
                <select id="experience" name="experience">
                    <option value="select" selected disabled>Choose Experience</option>
                    <option value="2+">2+ years</option>
                    <option value="1-2">1-2 years</option>
                    <option value="Fresher">Fresher</option>
                </select>
                <button type="submit">Post Job</button>
            </div>
            
      </form>
     
    </div>
  </body>
</html>
