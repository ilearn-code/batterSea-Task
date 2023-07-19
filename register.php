<?php

require "conn_db.php";

// Process the registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
$role=$_POST['role'];
  // Hash the password (replace with appropriate hashing algorithm)
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Prepare and execute the SQL statement
  $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashedPassword' , '$role')";
  if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
