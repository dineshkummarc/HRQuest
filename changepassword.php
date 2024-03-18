<?php 
session_start();

if (isset($_SESSION['username']) || isset($_SESSION['email'])) {

    if (isset($_SESSION['error'])) {
        $error_message = $_SESSION['error'];
        unset($_SESSION['error']);
    } else {
        $error_message = "";
    }

    if (isset($_SESSION['success'])) {
        $success_message = $_SESSION['success'];
        unset($_SESSION['success']);
    } else {
        $success_message = "";
    }

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="goback">
        <a href="userSettings.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
    <div class="container">
        <div class="box form-box">
            <form action="changed.php" method="post">
                <h2 style="margin-bottom: 20px;">Change Your Password</h2>
                <?php if (!empty($error_message)) { ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php } ?>
    
                <?php if (!empty($success_message)) { ?>
                    <p class="success"><?php echo $success_message; ?></p>
                <?php } ?>
                <div class="field input change">
                    <label>Old Password</label>
                    <input type="password" name="old" placeholder="Old Password">
        
                    <label>New Password</label>
                    <input type="password" name="new" placeholder="New Password">
        
                    <label>Confirm New Password</label>
                    <input type="password" name="changed" placeholder="Confirm New Password">
                </div>
                <div class="field">
                    <input type="submit" class="btn" value="Change password" name="submit" required>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php 
} else {
    header("Location: userDashboard.php");
    exit();
}
?>
