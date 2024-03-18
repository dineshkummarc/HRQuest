<?php
session_start();
// Check if the admin is logged in, if not, redirect to login page
if(!isset($_SESSION['admin_username'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register New Employee</title>
</head>
<body>
<div class="goback">
    <a href="adminDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
</div>
<div class="container">
    <div class="box form-box">
 <?php include 'database.php'; ?>
        <?php
        if (isset($_POST['submit'])) {
            $username = $_POST['e_username'];
            $email = $_POST['e_email'];
            $password = $_POST['e_password'];
            $confirmpassword = $_POST['e_confirmpassword'];
            $job_title = $_POST['job_title'];

            // Check if password and confirm password match
            if ($password == $confirmpassword) {
                // Check if email is already registered
                $verify_query = mysqli_query($conn, "SELECT e_email FROM employee WHERE e_email='$email'");
                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                            <p>This email is used, try another one please!</p>
                          </div>
                          <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                } else if (substr($email, -12) !== "@hrquest.com")  {
                    $error = "Email addresses must ends with '@hrquest.com'.";
                }
                 else {
                    // Insert new user if email is unique and passwords match
                    mysqli_query($conn, "INSERT INTO employee(e_username, e_email, e_password, e_jobtitle) VALUES('$username','$email','$password', '$job_title')") or die("error occured");
                    echo "<div class='message'>
                            <p>Employee registered successfully!</p><br>
                            <a style='padding:0'; href='registerEmployee.php'>Create new one.</a>
                          </div> <br>";
                }
            } else {
                echo "Password and confirm password do not match";
                echo "<a href='Register.php'><button class='btn'>Go back</button></a>";
            }
        } else {
            ?>
            <header>Register Employee</header>
            <form action="registerEmployee.php" method="post" onsubmit="return validateForm()">
                <div class="field input">
                    <label for="e_username">Username</label>
                    <input type="text" name="e_username" id="e_username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="e_email">Email</label>
                    <input type="email" name="e_email" id="e_email" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="e_password">Password</label>
                    <input type="password" name="e_password" id="e_password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="e_confirmpassword">Confirm password</label>
                    <input type="password" name="e_confirmpassword" id="e_confirmpassword" autocomplete="off" required>
                </div>
                <div class="field">
                    <label for="job_title">Job Title</label>
                    <select name="job_title" id="job_title" required>
                        <option value="" disabled selected>Select Job Title</option>
                        <?php
                        // Fetch job titles from the database
                        $sql = "SELECT job_title FROM jobs";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['job_title'] . "'>" . $row['job_title'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="field">
                    <input type="submit" class="btn" value="Register" name="submit" required>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<script>
    function validateForm() {
    var email = document.getElementById("e_email").value;
    if (!email.endsWith("@hrquest.com")) {
        alert("Email addresses must ends with '@hrquest.com'.");
        return false;
    }
    return true;
    }

    </script>
</body>
</html>