<?php
$server = "localhost";
$database = "hrquest";
$username="root";
$password ="";

$conn = new mysqli($server,$username,$password, $database);
if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}