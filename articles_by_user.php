<?php
include "conn_db.php";

// Check if user ID is provided in the URL
if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Fetch user information from the database
    $userSql = "SELECT * FROM users WHERE id = '$userId'";
    $userResult = mysqli_query($conn, $userSql);
    $user = mysqli_fetch_assoc($userResult);

    // Fetch articles by the selected user from the database
    $articlesSql = "SELECT * FROM articles WHERE user_id = '$userId'";
    $articlesResult = mysqli_query($conn, $articlesSql);
} else {
    // If no user ID is provided, redirect to the user management page or show an error message
    header("Location: user_management.php");
    exit;
}

// Handle article publishing
// if (isset($_POST['publish_article'])) {
//     $articleId = $_POST['article_id'];

//     // Update the article status as published in the database
//     $publishSql = "UPDATE articles SET status = 'published' WHERE id = '$articleId'";
//     if (mysqli_query($conn, $publishSql)) {
//         echo "Article published successfully!";
//     } else {
//         echo "Error: " . $publishSql . "<br>" . mysqli_error($conn);
//     }
// }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Articles by User</title>
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
    <h2>Articles by <?php echo $user['username']; ?></h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($articlesResult)) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td>
                    <?php if ($row['status'] === 'published') { ?>
                        <span>Published</span>
                    <?php } else { ?>
                        <form action="publish-byadmin.php" method="POST">
                        
                            <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                            <input type="submit" name="publish_article" value="Publish">
                        </form>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <a href="user-management.php">Back to User Management</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
