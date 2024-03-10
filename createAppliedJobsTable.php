<?php include 'database.php' ?>

<?php

$sql = "CREATE TABLE appliedJobs (
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email varchar(255) NOT NULL,
  contact varchar(255) NOT NULL,
  location varchar(255) NOT NULL,
  resume_path VARCHAR(255) DEFAULT NULL,
  jobtitle VARCHAR(255) NOT NULL
)";
if($conn->query($sql)===TRUE){
  echo "Table created successfully.";  
} else {
    die("Connection failed".$conn->connect_error);
}
?>