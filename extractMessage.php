<?php
session_start();
include 'database.php'; 


$receiver_id = $_SESSION['id']; 
$query = "SELECT * FROM messages WHERE receiver_id = '$receiver_id'";
$result = mysqli_query($conn, $query);
$messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<link rel="stylesheet" href="">

<h2>Received Messages</h2>
<ul>
    <?php foreach ($messages as $message): ?>
        <li>
            <strong>Subject:</strong> <?php echo $message['subject']; ?><br>
            <strong>Sender:</strong> <?php echo $message['sender_id']; ?><br>
            <strong>Date:</strong> <?php echo $message['timestamp']; ?><br>
            <a href="view_message.php?id=<?php echo $message['message_id']; ?>">View Message</a>
        </li>
    <?php endforeach; ?>
</ul>
