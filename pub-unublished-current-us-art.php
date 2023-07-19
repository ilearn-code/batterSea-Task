<?php
include "conn_db.php";
session_start();
$loggedInUserId = $_SESSION['user_id'];

// Fetch drafted articles by the logged-in user from the database
$sql = "SELECT id, title, content FROM articles WHERE user_id = '$loggedInUserId' AND status = 'draft'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Drafted Articles</title>
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
    <h2>Drafted Articles</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Publish</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['content']; ?></td>
                <td>
                    <form action="publish-byadmin.php" method="POST">
                        <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="publish_article" value="Publish">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
