<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="utf-8">
    <title>Login</title>
  </head>
<body class="bg-img">
<div class="goback">
    <!-- <a href="index.html"><button>Go Back</button></a> -->
    <a href="index.html"><i class="fa-solid fa-backward"></i>Go Back</a>
</div>
<div class="container">
    <div class="box form-box">
        <header style="font-size: 25px; text-align:center; border-bottom:none;">Login to your <span style="color: #4C5FD5;">Quest</span> account</header>
        <hr style="width: 20%; margin: 10px auto; border-color:#4C5FD5;">
        <h4 style="text-align: center; padding: 10px;">Continue with...</h4>
        <button class="google-btn">
            <a href="https://google.com"><i class="fa-brands fa-google"></i></a>
        </button><br>
        <hr>
        <p style="text-align: center;"><span>OR</span></p><br>
                <?php include 'database.php'?>
            <?php
            session_start();
              if(isset($_POST['submit'])){
                $username = mysqli_real_escape_string($conn,$_POST['username']);
                $password = mysqli_real_escape_string($conn,$_POST['password']);

                $result = mysqli_query($conn,"SELECT * FROM users WHERE (Email='$username' OR Username = '$username') AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['email'] = $row['Username'];
                    $_SESSION['id'] = $row['Id'];
                    header("Location: userDashboard.php");
                    exit();
                }

                $query = "SELECT * FROM manager WHERE (m_email='$username' OR m_username = '$username') AND m_password='$password'" or die("Select Error");
                $result = mysqli_query($conn, $query);
                $manager = mysqli_fetch_assoc($result);

                if(is_array($manager) && !empty($manager)){
                    $_SESSION['valid'] = $manager['m_email'];
                    $_SESSION['username'] = $manager['m_username'];
                    $_SESSION['email'] = $manager['m_username'];
                    $_SESSION['id'] = $manager['Id'];
                    header("Location: adminDashboard.php");
                    exit();
                }

                $querySecond = "SELECT * FROM employee WHERE (e_email='$username' OR e_username = '$username') AND e_password='$password'" or die("Select Error");
                $resultSecond = mysqli_query($conn, $querySecond);
                $employee = mysqli_fetch_assoc($resultSecond);

                if(is_array($employee) && !empty($employee)){
                    $_SESSION['valid'] = $employee['e_email'];
                    $_SESSION['username'] = $employee['e_username'];
                    $_SESSION['email'] = $employee['e_username'];
                    $_SESSION['id'] = $employee['Id'];
                    header("Location: employeeDashboard.php");
                    exit();
                }

                else{
                    echo "<div class='message'>
                              <p class='message'>Wrong Email or Password</p>
                           </div> <br>";
                   echo "<a href='login.php'><button class='but'>Go Back</button></a>";
                }
               
              }else{
            ?>
        <form action="login.php" method="post">
            <div class="field input">
                <label for="username">Username/Email</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>   
                </div>
            <div class="field">
                <input type="submit" class="btn" value="Login" name="submit" required>
            </div>
            <div class="links">
                Don't have account? <a href="register.php">Get started now</a>
            </div>
        </form>
    </div>
    <?php
              }
              ?>
</div>
</body>
</html>