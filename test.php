<?php require 'database.php' ?>

<?php
session_start();
if(isset($_POST['send_message'])){
    $sender_id = $_SESSION['id']; 
    $receiver_id = 'admin_id';
    $recipient_email = $_POST['recipient_email'];
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $timestamp = date('Y-m-d H:i:s');

    $query = "INSERT INTO messages (sender_id, receiver_id, subject, body, timestamp) VALUES ('$sender_id', '$receiver_id', '$subject', '$body', '$timestamp')";
    mysqli_query($conn, $query);
    echo 'Message sent successfully!';
}
?>

<link rel="stylesheet" href="sendEmail.css">

<form method="post" action="">
    <h2>Send Message</h2>
    <input type="hidden" name="receiver_id" value="admin_id">
    <input type="hidden" name="recipient_email" value="uttamshr10@gmail.com">
    <input type="text" name="subject" placeholder="Subject" required><br>
    <textarea name="body" placeholder="Message" rows="12" required></textarea>
    <button type="submit" name="send_message">Send Message</button>
</form>
