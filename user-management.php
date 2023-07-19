<?php
include "conn_db.php";

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Handle user deletion
if (isset($_POST['delete_user'])) {
    $userId = $_POST['user_id'];

    // Delete the user from the database
    $deleteSql = "DELETE FROM users WHERE id = '$userId'";
    if (mysqli_query($conn, $deleteSql)) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $deleteSql . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
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
<h2>User Management</h2>
<table>
<tr>
    <th>Username</th>
    <th>Email</th>
    <th>Action</th>
    <th>Edit</th>
    <th>View</th>
</tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="delete_user" value="Delete">
        </form>
    </td>
    <td>
        <form action="edit_user.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="edit_user" value="Edit">
        </form>
    </td>
    <td>
        <form action="articles_by_user.php?" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
            <input type="submit" name="edit_user" value="View Articles">
        </form>
    </td>
</tr>

    <?php } ?>
</table>
<a href="register.html">Add User</a>
<br>
<a href="dashboard.php">BAck To Dashboard</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
