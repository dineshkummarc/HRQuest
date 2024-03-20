<?php include 'database.php' ?>

<?php

$sql = "CREATE TABLE salaries (
  employee_email VARCHAR(255) NOT NULL,
  month_year VARCHAR(255) NOT NULL,
  amount int NOT NULL,
  job_title VARCHAR(255) NOT NULL
)";
if($conn->query($sql)===TRUE){
  echo "Table created successfully.";  
} else {
    die("Connection failed".$conn->connect_error);
}
?>