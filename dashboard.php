<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
session_start();
include "isAdmin.php";

$loginUser=$_SESSION['user_id'];

if(isAdmin($loginUser))
{
?>
    <a href="user-management.php">User Management</a>
    <br>
    <br>
    <br>
    <a href="published-articles.php">Article Management</a>
    <br>
    <br>
    <br>
    <?php } ?>
    <a href="profile_edit.php">Profile</a>

    <br>
    <br>
    <br>
    <a href="EditorPage.php">Editor Page</a>

    <br>
    <br>
    <br>
    <a href="published_articles_all.php">Published Articles By Users</a>
    <br>
    <br>
    <a action="logout.php" href="login.html">Logout</a>
</body>
</html>