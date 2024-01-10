<?php
include("connect.php");

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the AJAX request
    $electionTitle = $_POST["electionTitle"];
    $newStatus = $_POST["newStatus"];

    // Update the database record
    $queryUpdateStatus = "UPDATE election SET Status = ? WHERE Title = ?";
    $stmtUpdateStatus = mysqli_prepare($connect, $queryUpdateStatus);
    mysqli_stmt_bind_param($stmtUpdateStatus, 'ss', $newStatus, $electionTitle);

    if (mysqli_stmt_execute($stmtUpdateStatus)) {
        echo "Database updated successfully";
    } else {
        echo "Error updating database";
    }

    mysqli_stmt_close($stmtUpdateStatus);
    mysqli_close($connect); // Close the database connection
} else {
    echo "Invalid request"; // Handle invalid requests
}
?>