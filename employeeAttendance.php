<?php
session_start();

// Check if any user is logged in, if not, redirect to login page
if(!isset($_SESSION['admin_username'])){
    header("Location: login.php");
    exit();
}

// Retrieve the username from the URL
if(isset($_GET['email'])) {
    $email = $_GET['email'];

    // Use the username to fetch attendance records for this employee
    require 'database.php';
    $sql = "SELECT * FROM attendance_records WHERE e_email = '$email'";
    $result = $conn->query($sql);
    $attendance_records = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $attendance_records[] = $row;
        }
    }
    $conn->close();
} else {
    // Handle the case where no username is provided in the URL
    echo "Employee email not provided.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
    <link rel="stylesheet" href="appliedJob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="goback">
        <a href="admin_attendance.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
    <div id="container">
        <h2>Attendance of <?php echo $attendance_records[0]["e_username"]; ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Check In Time</th>
                    <th>Check Out Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendance_records as $record): ?>
                    <tr>
                        <td><?php echo $record['e_username']; ?></td>
                        <td><?php echo $record['e_email']; ?></td>
                        <td><?php echo $record['check_in_time']; ?></td>
                        <td><?php echo $record['check_out_time']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
