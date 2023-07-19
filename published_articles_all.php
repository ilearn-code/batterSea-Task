<?php
include "conn_db.php";
session_start();
// Fetch published articles from the database
$sql = "SELECT articles.id, articles.title, articles.content, users.username FROM articles INNER JOIN users ON articles.user_id = users.id WHERE articles.status = 'published'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Published Articles By All</title>
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
  <h2>Published Articles By All</h2>
  <table>
    <tr>
      <th>Title</th>
      <th>Content</th>
      <th>Author</th>
      <?php if (isset($_SESSION['user_id'])) { ?>
        <th>Edit</th>
        <th>Delete</th>
      <?php } ?>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['content']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <?php if (isset($_SESSION['user_id'])) {
          $userId = $_SESSION['user_id'];
          $articleId = $row['id'];
          // Check if the logged-in user is the owner of the article
          $ownershipSql = "SELECT * FROM articles WHERE id = '$articleId' AND user_id = '$userId'";
          $ownershipResult = mysqli_query($conn, $ownershipSql);
          $isOwner = mysqli_num_rows($ownershipResult) > 0;
          
          if ($isOwner) { ?>
            <td><a href="edit-article.php?id=<?php echo $row['id']; ?>">Edit</a></td>
            <td><a href="delete-article.php?id=<?php echo $row['id']; ?>">Delete</a></td>
          <?php } else { ?>
            <td></td>
            <td></td>
          <?php }
        } ?>
      </tr>
    <?php } ?>
  </table>
  <br>
  <a href="dashboard.php">Back To Dashboard</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
