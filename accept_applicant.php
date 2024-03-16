<?php
// Include database connection code
require 'database.php';

// Get the applicant ID from the URL parameter
$applicant_id = $_GET['id'];

// Execute SQL query to move applicant to accepted table
$sql = "INSERT INTO accepted SELECT * FROM appliedjobs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $applicant_id);
$stmt->execute();

// Check if the operation was successful
if ($stmt->affected_rows > 0) {
    // Delete applicant from appliedjobs table
    $delete_sql = "DELETE FROM appliedjobs WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $applicant_id);
    $delete_stmt->execute();

    // Return success response
    http_response_code(200);
    echo "Applicant accepted successfully";
} else {
    // Return error response
    http_response_code(500);
    echo "Error: Unable to accept applicant";
}

// Close database connection
$stmt->close();
$conn->close();
?>
