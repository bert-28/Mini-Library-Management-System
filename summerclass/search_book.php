// If a search term is provided in the URL
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM books WHERE book_name LIKE '%$search%' OR writer LIKE '%$search%'";