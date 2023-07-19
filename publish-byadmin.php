<?php
include "conn_db.php";
if (isset($_POST['publish_article'])) {
    $articleId = $_POST['article_id'];

    // Update the article status as published in the database
    $publishSql = "UPDATE articles SET status = 'published' WHERE id = '$articleId'";
    if (mysqli_query($conn, $publishSql)) {
        echo "Article published successfully!";
    } else {
        echo "Error: " . $publishSql . "<br>" . mysqli_error($conn);
    }
}
?>