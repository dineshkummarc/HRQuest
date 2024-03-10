<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Page</title>
</head>
<body>
<div class="goback">
    <!-- <a href="index.html"><button>Go Back</button></a> -->
    <a href="index.html"><i class="fa-solid fa-backward"></i>Go Back</a>
</div>
<div class="container">
    <div class="box form-box">
 <?php include 'database.php'; ?>
        <?php
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];

            // Check if password and confirm password match
            if ($password == $confirmpassword) {
                // Check if email is already registered
                $verify_query = mysqli_query($conn, "SELECT Email FROM users WHERE Email='$email'");
                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                            <p>This email is used, try another one please!</p>
                          </div>
                          <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                } else if (substr($email, -12) === "@hrquest.com")  {
                    $error = "Email addresses ending with '@hrquest.com' are not allowed.";
                }
                 else {
                    // Insert new user if email is unique and passwords match
                    mysqli_query($conn, "INSERT INTO users(Username,Email,Password) VALUES('$username','$email','$password')") or die("error occured");
                    echo "<div class='message'>
                            <p>Registration successfully!</p>
                          </div> <br>";
                    echo "<a href='Login.php'><button class='btn'>Login Now</button></a>";
                }
            } else {
                echo "Password and confirm password do not match";
                echo "<a href='Register.php'><button class='btn'>Go back</button></a>";
            }
        } else {
            ?>
        <header>Register Now</header>
        
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off" required>
            </div>
            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autocomplete="off" required>
            </div>
            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
                
            </div>
              <div class="field input">
                <label for="confirmpassword">Confirm password</label>
                <input type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required>
            </div>
            <div class="field">
                <input type="submit" class="btn" value="Register" name="submit" required>
            </div>
            <div class="links">
            Already have account <a href="login.php">Sign In</a>
            </div>
        </form>
    </div>
    <?php
         }
         ?>
</div>
<script>
        function validateForm() {
            var email = document.getElementById("email").value;
            if (email.endsWith("@hrquest.com")) {
                alert("Email addresses ending with '@hrquest.com' are not allowed.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>