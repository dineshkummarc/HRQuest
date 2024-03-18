<?php include 'database.php' ?>

<?php

$sql = "CREATE TABLE attendance_records (
  e_username VARCHAR(255) NOT NULL,
  e_email VARCHAR(255) NOT NULL,
  check_in_time DATETIME NOT NULL,
  check_out_time DATETIME NOT NULL
)";
if($conn->query($sql)===TRUE){
  echo "Table created successfully.";  
} else {
    die("Connection failed".$conn->connect_error);
}
?>