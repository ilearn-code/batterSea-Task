<?php
include "conn_db.php";

// Fetch the article ID from the query string
$articleId = $_GET['id'];

// Delete the article from the database
$sql = "DELETE FROM articles WHERE id = '$articleId'";
if (mysqli_query($conn, $sql)) {
  echo "Article deleted successfully!";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
