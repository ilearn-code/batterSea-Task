<?php
include "conn_db.php";

// Fetch all registered users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>View Users</title>
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
  <h2>View Users</h2>
  <table>
    <tr>
      <th>Username</th>
      <th>Email</th>
      <th>Action</th>
      <!-- <th>View Users</th> -->
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><a href="publish-article.php?userId=<?php echo $row['id']; ?>">Publish Article</a></td>
        
      </tr>
    <?php } ?>
  </table>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
