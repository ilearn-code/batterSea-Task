<?php
include "conn_db.php";

// Fetch the article ID from the query string
$articleId = $_GET['id'];

// Fetch the article from the database based on the ID
$sql = "SELECT * FROM articles WHERE id = '$articleId'";
$result = mysqli_query($conn, $sql);
$article = mysqli_fetch_assoc($result);

// Handle form submission to update the article
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $content = $_POST['content'];

  // Prepare and execute the SQL statement
  $sql = "UPDATE articles SET title = '$title', content = '$content' WHERE id = '$articleId'";
  if (mysqli_query($conn, $sql)) {
    echo "Article updated successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Article</title>
</head>
<body>
  <h2>Edit Article</h2>
  <form action="edit-article.php?id=<?php echo $articleId; ?>" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo $article['title']; ?>" required><br><br>
    
    <label for="content">Content:</label>
    <textarea id="content" name="content" rows="4" cols="50" required><?php echo $article['content']; ?></textarea><br><br>
    
    <input type="submit" value="Update">
  </form>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
