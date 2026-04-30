<?php
include 'db_config.php';

// Check if an ID was actually sent in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure the ID is a number for security

    $sql = "DELETE FROM books WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Refresh the dashboard to show the updated list
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>