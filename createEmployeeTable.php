<?php include 'database.php' ?>

<?php

$sql = "CREATE TABLE employee (e_username varchar(200), e_email varchar(200), e_password varchar(200), e_jobtitle varchar(200))";
if($conn->query($sql)===TRUE){
  echo "Table created successfully.";  
} else {
    die("Connection failed".$conn->connect_error);
}
?>