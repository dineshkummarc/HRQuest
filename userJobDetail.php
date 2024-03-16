<?php
include 'database.php';
session_start(); // Start session if not already started

$job_id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM jobs WHERE id = $job_id");
$row = mysqli_fetch_assoc($result);
$key_benefits = array(
  "Flexible working hours",
  "Opportunities for career growth",
  "Training and development programs",
  "Competitive salary and benefits package",
  "Supportive work environment"
);

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['username']) || isset($_SESSION['email']);

// Check if the user has already applied for this job
$isApplied = false;
$isAccepted = false;
$isRejected = false;
if ($userLoggedIn) {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    
    // Check if the user's email or username exists in the appliedJobs table for the given job title
    $queryApplied = "SELECT COUNT(*) AS count FROM appliedJobs WHERE (email = '$email' OR username = '$username') AND jobtitle = '{$row['job_title']}'";
    $resultApplied = mysqli_query($conn, $queryApplied);
    $dataApplied = mysqli_fetch_assoc($resultApplied);
    $isApplied = $dataApplied['count'] > 0;

    // Check if the user has been accepted for this job
    $queryAccepted = "SELECT COUNT(*) AS count FROM accepted WHERE (email = '$email' OR username = '$username') AND jobtitle = '{$row['job_title']}'";
    $resultAccepted = mysqli_query($conn, $queryAccepted);
    $dataAccepted = mysqli_fetch_assoc($resultAccepted);
    $isAccepted = $dataAccepted['count'] > 0;

    // Check if the user has been rejected for this job
    $queryRejected = "SELECT COUNT(*) AS count FROM rejected WHERE (email = '$email' OR username = '$username') AND jobtitle = '{$row['job_title']}'";
    $resultRejected = mysqli_query($conn, $queryRejected);
    $dataRejected = mysqli_fetch_assoc($resultRejected);
    $isRejected = $dataRejected['count'] > 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Detail</title>
    <link rel="stylesheet" href="jobdetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="row-first">
            <a href="userCareer.php"><i class="fa-solid fa-backward"></i>Go Back</a>
            <?php
            echo "<h2>" . $row['job_title'] . "</h2>";
            echo '<p><i class="fa-solid fa-building"></i>' . $row["jobtype"] . '</p>';
            $skills = explode(',', $row['skills']);
            echo '<ul class="skill">';
            echo '<i class="fa-regular fa-star"></i>';
            foreach ($skills as $skill) {
                echo '<li>' . trim($skill) . '</li>';
            }
            echo '</ul>';
            echo '<p><i class="fa-solid fa-location-dot"></i>' . $row["location"] . '</p>';

            if (isset($row['id'])) {
                if ($isAccepted) {
                    echo "<a class='apply' href=''><button style='background: green; color: #fff;' disabled><i class='fa-solid fa-lock'></i>Accepted</button></a><br>";
                } elseif ($isRejected) {
                    echo "<a class='apply' href=''><button style='background: red; color: #fff;' disabled><i class='fa-solid fa-lock'></i>Rejected</button></a><br>";
                } elseif ($isApplied) {
                    echo "<a class='apply' href=''><button style='color: #fff;' disabled><i class='fa-solid fa-lock'></i>Applied</button></a><br>";
                } else {
                    echo "<a class='apply' href='applyNow.php?id=" . $row['id'] . "'><button>Apply Now</button></a><br>";
                }
            } else {
                echo "<p>Error: Job ID not found</p>";
            }
            ?>
        </div>
        <div class="row-second">
            <h3>Company Description</h3>
            <p>At <b>HR Quest,</b> we connect talented individuals with rewarding career opportunities. We specialize in matching candidates with roles that align with their skills and aspirations, facilitating mutual growth and success.</p><br>
            <h3>Job Description</h3>
            <?php
            echo "<p>" . $row['job_description'] . "</p><br>";
            ?>
            <h3>Qualifications</h3>
            <?php
             $education = $row['education']; 
             if ($education == "Master" || $education == "Bachelor") {
              echo "<p>Education Level: <b>" . $education . "'s degree</b> from a recognized university.</p>";
            } else if ($education == "High School") {
                echo "<p>Education Level: <b>" . $education . " degree</b> from a recognized board.</p>";
            } else {
              echo "<p><b>No Education Required</b></p>";
            }
            $experience = $row["experience"];
            if ($experience == "2+"){
              echo '<p>Experience Required: <b>' . $experience . '</b> years of professional experience.<p><br>'; 
            } else if ($experience == "1-2"){
              echo '<p>Experience Required: <b>' . $experience . ' years</b> of professional experience.<p><br>';
            } else {
              echo '<p><b>No Experience Required.</b></p><br>';
            }
            echo "<h3>Salary : " . $row['salary'] . "</h3><br>" ;
            ?>
            <h3>Key Benefits Working with Us</h3>
            <ul class="key-benefits">
              <?php
                foreach($key_benefits as $benefit){
                  echo "<li>$benefit</li>";
                }
              ?>
          </ul>
        </div>
    </div>
</div>
</body>
</html>
