<?php
include "conn_db.php";

// Process the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Fetch the user record from the database based on email
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // Verify the password
    if (password_verify($password, $user['password'])) {
      // Start a session and store user data
      session_start();
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];

      // Redirect to a protected page (e.g., user dashboard)
      header("Location: dashboard.php");
      exit();
    } else {
      echo "Invalid email or password.".$user['password'];
    }
  } else {
    echo "Invalid email or password";
  }
}

// Close the database connection
mysqli_close($conn);
?>
