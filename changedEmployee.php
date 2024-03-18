<?php 
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['email'])) {

    include "database.php";

    if (isset($_POST['old']) && isset($_POST['new']) && isset($_POST['changed'])) {

        function validate($data){
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }

        $old = validate($_POST['old']);
        $new = validate($_POST['new']);
        $changed = validate($_POST['changed']);
        
        if(empty($old)){
          $_SESSION['error'] = "Old Password is required";
        } else if(empty($new)){
          $_SESSION['error'] = "New Password is required";
        } else if($new !== $changed){
          $_SESSION['error'] = "The confirmation password does not match";
        } else {
            $email = $_SESSION['email'];
            $username = $_SESSION['username'];

            $sql = "SELECT e_password
                    FROM employee WHERE 
                    e_email='$email' OR e_username = '$username' AND e_password='$old'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) === 1){
                
                $sql_2 = "UPDATE employee
                          SET e_password='$new'
                          WHERE e_email='$email' OR e_username = '$username'";
                if (mysqli_query($conn, $sql_2)) {
                    $_SESSION['success'] = "Password has been changed successfully";
                } else {
                    $_SESSION['error'] = "Error updating password";
                }

            } else {
                $_SESSION['error'] = "Incorrect password";
            }

        }
        
        header("Location: empChangePassword.php");
        exit();

    } else {
        header("Location: empChangePassword.php");
        exit();
    }

} else {
    header("Location: employeeDashboard.php");
    exit();
}
?>
