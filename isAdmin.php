<?php
include "conn_db.php";
function isAdmin($userId) {
    global $conn;
    $sql = "SELECT role FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user['role'] === 'admin';
}

?>