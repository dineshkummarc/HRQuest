<?php
session_start();

// Include database connection
require_once 'database.php';

// Check if any user is logged in, if not, redirect to login page
if (!isset($_SESSION['employee_username'])) {
    header("Location: login.php");
    exit();
}

// Fetch employee email from the employee table based on the logged-in username
$employee_username = $_SESSION['username'];
$e_email = $_SESSION['email'];
$sql_email = "SELECT e_email FROM employee WHERE e_username='$employee_username' OR e_email = '$e_email'";
$result_email = $conn->query($sql_email);

if ($result_email->num_rows > 0) {
    $row_email = $result_email->fetch_assoc();
    $employee_email = $row_email['e_email'];
} else {
    // Handle the case where email is not found for the logged-in username
    echo "<script>alert('Employee not found.')</script>";
    exit();
}

// Fetch job title for the employee
$sql_job = "SELECT e_jobtitle FROM employee WHERE e_email='$employee_email'";
$result_job = $conn->query($sql_job);
$job_title = "";
if ($result_job->num_rows > 0) {
    $row_job = $result_job->fetch_assoc();
    $job_title = $row_job['e_jobtitle'];
}

// Fetch salaries based on employee email
$sql_salary = "SELECT * FROM salaries WHERE employee_email='$employee_email'";
$result_salary = $conn->query($sql_salary);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Payroll</title>
    <link rel="stylesheet" href="payroll.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="goback">
            <a href="employeeDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
        </div>
<div class="container">
    <h2>Your Salary Details</h2>
    <?php if ($result_salary->num_rows > 0): ?>
        <table>
            <tr>
                <th>Year-Month</th>
                <th>Amount</th>
            </tr>
            <?php while ($row_salary = $result_salary->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row_salary['month_year']; ?></td>
                    <td><?php echo $row_salary['amount']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No salary details found.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
