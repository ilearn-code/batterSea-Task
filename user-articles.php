<?php
include "conn_db.php";
// Fetch articles created by users from the database
$sql = "SELECT articles.id, articles.title, articles.content, users.username FROM articles INNER JOIN users ON articles.user_id = users.id WHERE articles.status = 'draft'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Articles</title>
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
<h2>User Articles</h2>
<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Author</th>
        <th>Publish</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['content']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><a href="publish-article.php?articleId=<?php echo $row['id']; ?>">Publish</a></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
