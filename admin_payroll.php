<?php
session_start();

// Include database connection
require_once 'database.php';

// Add Salary for Employee
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_salary'])) {
    $employee_email = $_POST['employeeemail'];
    $month_year = $_POST['month_year'];
    $amount = $_POST['amount'];

    // Fetch employee's job title
    $sql_job = "SELECT e_jobtitle FROM employee WHERE e_email='$employee_email'";
    $result_job = $conn->query($sql_job);
    if ($result_job->num_rows > 0) {
        $row_job = $result_job->fetch_assoc();
        $job_title = $row_job['e_jobtitle'];

        // Insert salary with employee's job title
        $sql = "INSERT INTO salaries (employee_email, month_year, amount, job_title) 
                VALUES ('$employee_email', '$month_year', '$amount', '$job_title')";

        if ($conn->query($sql) === TRUE) {
            echo"<script>alert('Salary added successfully.')</script>" ;

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Employee not found.')</script>";
    }
}

// Increase Salary for Employee
// Modification needed: Remove this section as requested

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Payroll Management</title>
    <link rel="stylesheet" href="Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
<div class="goback">
        <a href="userDashboard.php"><i class="fa-solid fa-backward"></i>Go Back</a>
    </div>
    <div class="box form-box" id="addSalaryForm">
        <h2>Add Salary for Employee</h2>
        <form action="" method="post">
            <div class="field input">
                <label for="employeeemail">Employee Email</label>
                <input type="email" name="employeeemail" id="employeeemail" required>   
            </div>
            <div class="field input">
                <label for="monthandyear">Year and Month</label>
                <input type="text" name="month_year" id="month_year" required>   
            </div>
            <div class="field input">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount"  required>   
            </div>
            <div class="field">
                <input class='btn' type="submit" name="add_salary" value="Add Salary">
            </div>
        </form>
    </div>
</div>

</body>
</html>