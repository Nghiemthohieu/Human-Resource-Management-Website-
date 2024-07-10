<?php
session_start();
include "../includes/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_personnal = htmlspecialchars($_SESSION['user_id']);
    $current_password = $_POST['current_password'];
    // Truy vấn cơ sở dữ liệu để lấy mật khẩu hiện tại
    $sql = "SELECT password FROM personnal WHERE ID_personnal = '$ID_personnal'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($current_password==$row['password']) {
        echo "OK";
    } else {
        echo "NOT_OK";
    }
}
?>