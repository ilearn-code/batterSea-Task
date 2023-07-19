<?php
include "conn_db.php";

if (isset($_POST['update_user'])) {
    $userId = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update the user's information in the database
    $updateSql = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$userId'";
    if (mysqli_query($conn, $updateSql)) {
        echo "User updated successfully!";
    } else {
        echo "Error: " . $updateSql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
