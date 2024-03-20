<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HR Quest</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    #nav {
    background-color: whitesmoke;
    color: antiquewhite;
    height: 90px;
    width: 90%;
    border-radius: 50px;
    margin-left: 50px;
    /* border: 2px solid red; */
    position: fixed;
    top: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    justify-content: space-evenly;
    }

    #nav a {
        text-decoration: none;
    }

    #container{
        padding: 15px;
        margin-bottom: 20px;
    }

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div id="container">
    <div id="nav">
            <a href="userDashboard.php">Home</a>
            <a href="userCareer.php">Apply Now</a>
            <a href="jobstatus.php">Job Status</a>
            <a href="userSettings.php">Settings</a>
            <a href="logout.php">Logout</a>
      </div>
</div>
  <!-- Career Section -->
  <div id="careers">
    <div class="container">
      <h1 class="title" style="text-align: left; font-size: 40px;">Current Openings</h1>
      <div class="careers">
        <?php
        include 'database.php';
        $result = mysqli_query($conn, "SELECT * FROM jobs");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="career-card">
        <div class="career-icon">
            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['job_title']; ?>">
        </div>
          <div class="career-heading">
            <h3><?php echo $row['job_title']; ?></h3>
          </div>
          <div class="career-text">
          <p><?php
            $job_description = $row['job_description'];
            $position = strpos($job_description, '.');
            if ($position !== false) {
                $job_description = substr($job_description, 0, $position + 1);
            }
            echo $job_description;
          ?>
             </p>
          </div>
          <div class="learn-more">
            <?php
            if (isset($row['id'])) {
                echo "<a href='userJobDetail.php?id=" . $row['id'] . "'>Learn More</a>" . "<br>";
            } else {
                echo "<p>Error: Job ID not found</p>";
            }
            ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
</div>
   
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="script.js"></script>


</body>
</html>
