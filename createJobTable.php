<?php include 'database.php' ?>

<?php

$sql = "CREATE TABLE jobs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  job_title VARCHAR(255) NOT NULL,
  job_description TEXT NOT NULL,
  image_path VARCHAR(255) DEFAULT NULL,
  location varchar(255) NOT NULL,
  salary varchar(255) NOT NULL,
  skills VARCHAR(255) NOT NULL,
  jobtype VARCHAR(255) NOT NULL,
  education VARCHAR(255) NOT NULL,
  experience varchar(255) NOT NULL
)";
if($conn->query($sql)===TRUE){
  echo "Table created successfully.";  
} else {
    die("Connection failed".$conn->connect_error);
}
?>