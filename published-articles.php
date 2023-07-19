<?php
include "conn_db.php";

// Fetch published articles from the database
$sql = "SELECT articles.id, articles.title, articles.content, users.username FROM articles INNER JOIN users ON articles.user_id = users.id WHERE articles.status = 'published'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Published Articles</title>
  <style>
    table {
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border: 1px solid black;
    }
  </style>
</head>
<body>
  <h2>Published Articles</h2>
  <table>
    <tr>
      <th>Title</th>
      <th>Content</th>
      <th>Author</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['content']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><a href="edit-article.php?id=<?php echo $row['id']; ?>">Edit</a></td>
        <td><a href="delete-article.php?id=<?php echo $row['id']; ?>">Delete</a></td>
        
      </tr>
    <?php } ?>
  </table>
  <a href="create-article.html">Add Articles</a>
  <br>
  <a href="dashboard.php">BAck To Dashboard</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
