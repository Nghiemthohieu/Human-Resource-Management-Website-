<?php
session_start();
include "../includes/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ID_personnal = htmlspecialchars($_SESSION['user_id']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu mới và xác nhận mật khẩu có khớp không
    if ($new_password !== $confirm_password) {
        echo "New passwords do not match.";
        exit;
    }

    // Truy vấn cơ sở dữ liệu để lấy mật khẩu hiện tại
    $sql = "SELECT password FROM personnal WHERE ID_personnal = '$ID_personnal'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    var_dump($current_password);
    var_dump($row['password']);
    if ($current_password!=$row['password']) {
        echo "Current password is incorrect.";
        exit;
    }

    // Mã hóa mật khẩu mới
    // $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Cập nhật mật khẩu trong cơ sở dữ liệu
    $update_sql = "UPDATE personnal SET password = '$new_password' WHERE ID_personnal = '$ID_personnal'";
    if (mysqli_query($conn, $update_sql)) {
        echo "OK";
        header("location: /Web_quan_ly_nhan_su/admin/information/information.php");
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }
}
?>
