<?php
session_start();

// If session doesn't exist, redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_config.php';

// SQL query to get the total number of books
$countSql = "SELECT COUNT(*) as total FROM books";
$countResult = $conn->query($countSql);
$countRow = $countResult->fetch_assoc();
$totalBooks = $countRow['total'];

// Fetch books from database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>
<header class="top-nav">
    <form action="index.php" method="GET" class="search-box">
        <i class="fa fa-search"></i>
        <input type="text" name="search" placeholder="What do you want to find?" value="<?php echo htmlspecialchars($searchTerm); ?>">
    </form>

    <div class="user-controls">
    <i class="fa fa-bell icon-btn"></i>
    <i class="fa fa-comment-dots icon-btn"></i>
    <div class="profile-card">
        <img src="avatar.jpg" alt="Admin" class="avatar">
        <div class="profile-text">
            <strong><?php echo $_SESSION['full_name']; ?></strong>
            <span>Admin</span>
        </div>
        <a href="logout.php" title="Logout" style="color: #999; margin-left: 10px;">
            <i class="fa fa-sign-out-alt"></i>
        </a>
    </div>
</div>
            
            <img src="avatar.jpg" alt="Admin" class="avatar">
            <div class="profile-text">
                <strong>Priscilla Lily</strong>
                <span>Admin</span>
            </div>
            <i class="fa fa-chevron-down"></i>
        </div>
    </div>
</header>
<tbody>
    <?php 
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            // Inside your index.php while loop:
echo "<td class='actions'>
<a href='delete_book.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure?')\">
    <i class='fa fa-trash text-danger'></i>
</a>
<i class='fa fa-edit text-muted'></i>
</td>";
            echo "<td><input type='checkbox'></td>";
            echo "<td class='book-name'>" . $row['book_name'] . "</td>";
            echo "<td>" . $row['writer'] . "</td>";
            echo "<td>" . $row['book_id'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['class'] . "</td>";
            // Formatting date back to the look in your image
            echo "<td>" . date("d M, Y", strtotime($row['publish_date'])) . "</td>";
            echo "<td class='actions'>
                    <i class='fa fa-trash text-danger'></i>
                    <i class='fa fa-edit text-muted'></i>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No books found</td></tr>";
    }
    ?>
</tbody>