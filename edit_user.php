<?php
include "conn_db.php";

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Retrieve the user's information from the database
    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // Display the form to edit user profile
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit User</title>
    </head>
    <body>
        <h2>Edit User</h2>
        <form action="update_user.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $user['username']; ?>"><br>
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $user['email']; ?>"><br>
            <input type="submit" name="update_user" value="Update">
        </form>
    </body>
    </html>
    <?php
}

// Close the database connection
mysqli_close($conn);
?>
