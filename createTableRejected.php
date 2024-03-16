<?php include 'database.php' ?>

<?php

$sql = "CREATE TABLE rejected (
  id INT AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  contact VARCHAR(255) NOT NULL,
  location VARCHAR(255) NOT NULL,
  resume_path VARCHAR(255) DEFAULT NULL,
  jobtitle VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL
)";
if($conn->query($sql)===TRUE){
  echo "Table created successfully.";  
} else {
    die("Connection failed".$conn->connect_error);
}
?>