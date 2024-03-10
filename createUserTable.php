<?php include 'database.php' ?>

<?php

$sql = "CREATE TABLE users (Username varchar(200), Email varchar(200), Password varchar(200))";
if($conn->query($sql)===TRUE){
  echo "Table created successfully.";  
} else {
    die("Connection failed".$conn->connect_error);
}
?>