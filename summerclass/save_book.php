<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
    $writer = mysqli_real_escape_string($conn, $_POST['writer']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $publish_date = $_POST['publish_date'];

    $sql = "INSERT INTO books (book_id, book_name, writer, subject, class, publish_date) 
            VALUES ('$book_id', '$book_name', '$writer', '$subject', '$class', '$publish_date')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to main dashboard on success
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>