<?php
session_start();

// Check if any user is logged in, if not, redirect to login page
if(!isset($_SESSION['admin_username'])){
    header("Location: login.php");
    exit();
}
?>
<?php
require 'database.php';
// $sql = "SELECT * FROM attendance_records ORDER BY check_in_time DESC LIMIT 2";
$sql = "SELECT a.*
FROM attendance_records a
INNER JOIN (
    SELECT e_username, MAX(check_in_time) AS latest_check_in_time
    FROM attendance_records
    GROUP BY e_username
) b ON a.e_username = b.e_username AND a.check_in_time = b.latest_check_in_time
ORDER BY a.check_in_time DESC";

$result = $conn->query($sql);
$attendance_records = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendance_records[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Employee Attendance</title>
    <link rel="stylesheet" href="appliedJob.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="container">
    <div class="goback">
        <a href="adminDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
        <h2>Employee Attendance</h2>
        <table>
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Employee Email</th>
                    <th>Check In Time</th>
                    <th>Check Out Time</th>
                    <th>See More</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendance_records as $record): ?>
                    <tr>
                        <td><?php echo $record['e_username']; ?></td>
                        <td><?php echo $record['e_email']; ?></td>
                        <td><?php echo $record['check_in_time']; ?></td>
                        <td><?php echo $record['check_out_time']; ?></td>
                        <td><a href='employeeAttendance.php?email=<?php echo $record['e_email']; ?>'>Check Attendance</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>