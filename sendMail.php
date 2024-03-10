<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Send Email</title>
    <link rel="stylesheet" href="sendEmail.css">
</head>
<body>
    <form method="post" action="">
        <h2>Send Email</h2>
        <label for="recipient_email">Recipient Email:</label>
        <input type="text" id="recipient_email" name="recipient_email" required><br>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="12" required></textarea><br>

        <input type="submit" value="Send Email">
    </form>
</body>
</html>
