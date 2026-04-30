<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .submit-btn {
            background: #8a33fd;
            color: white;
            border: none;
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add New Book</h2>
        <form action="save_book.php" method="POST">
            <label>Book ID (e.g., #0025)</label>
            <input type="text" name="book_id" required>

            <label>Book Name</label>
            <input type="text" name="book_name" required>

            <label>Writer</label>
            <input type="text" name="writer" required>

            <label>Subject</label>
            <input type="text" name="subject">

            <label>Class</label>
            <input type="text" name="class">

            <label>Publish Date</label>
            <input type="date" name="publish_date" required>

            <button type="submit" class="submit-btn">Save to Library</button>
        </form>
    </div>
</body>
</html>