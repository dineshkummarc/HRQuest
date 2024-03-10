<?php include 'database.php' ?>
<?php
$message = "CREATE TABLE messages (
    message_id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    subject VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('unread', 'read') DEFAULT 'unread'
)";
if ($conn->query($message)===TRUE){
    echo 'Table created successfully';
} else {
    die("Connection failed".$conn->connect_error);
}
?>