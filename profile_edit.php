<?php
// Start session or include necessary authentication code
session_start();
include "conn_db.php";
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or show an error message
    header("Location: login.html");
    exit;
}

// Get the user ID from the session
$userId = $_SESSION['user_id'];

// Retrieve the user's current profile information from the database
$sql = "SELECT * FROM users WHERE id = $userId";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle form submission
if (isset($_POST['updateProfile'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Perform necessary validations and data sanitization

    // Update user information in the database
    $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$userId";
    if (mysqli_query($conn, $sql)) {
        echo "Profile updated successfully";
        // Optionally, you can redirect the user to a success page
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Edit</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <input type="submit" name="updateProfile" value="Update Profile">
    </form>
    <a href="dashboard.php">BAck To Dashboard</a>
</body>
</html>
