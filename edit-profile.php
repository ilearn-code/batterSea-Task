<?php
include "conn_db.php";

// Fetch the user ID from the session
$userId = $_SESSION['user_id'];

// Fetch the user's existing data from the database
$sql = "SELECT * FROM users WHERE id = '$userId'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Handle form submission to update the user profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];

  // Prepare and execute the SQL statement
  $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$userId'";
  if (mysqli_query($conn, $sql)) {
    echo "Profile updated successfully!";
    // Update the stored username in the session
    $_SESSION['username'] = $username;
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Profile</title>
</head>
<body>
  <h2>Edit Profile</h2>
  <form action="edit-profile.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>
    
    <input type="submit" value="Update">
  </form>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
