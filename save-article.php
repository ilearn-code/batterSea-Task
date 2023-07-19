<?php
// Start a session (if not already started)
include "conn_db.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}



// Process the article form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userId = $_SESSION['user_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  // Prepare and execute the SQL statement
  $sql = "INSERT INTO articles (user_id, title, content, status) VALUES ('$userId', '$title', '$content', 'draft')";
  if (mysqli_query($conn, $sql)) {
    echo "Article saved successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
