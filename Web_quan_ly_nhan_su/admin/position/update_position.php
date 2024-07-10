<?php

// Nhận dữ liệu từ form
$fullname = $_POST['fullnameEdit'];
$SalesmilestoneEdit = $_POST['SalesmilestoneEdit'];
$completiontimeEdit = $_POST['completiontimeEdit'];
$KPIsEdit = $_POST['KPIsEdit'];
$positionId = $_POST['positionId'];
$SalesmilestoneEdit = str_replace('.', '', $SalesmilestoneEdit);
$completiontimeEdit = str_replace('.', '', $completiontimeEdit);
$KPIsEdit = str_replace('.', '', $KPIsEdit);
// Kết nối db
require_once 'conn_position.php';

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Viết lệnh SQL để cập nhật dữ liệu sử dụng prepared statements
$updatesql = "UPDATE position SET name=?, Sales_milestone=?, completion_time=?, KPIs=? WHERE ID=?";

// Chuẩn bị câu lệnh
$stmt = $conn->prepare($updatesql);

// Kiểm tra nếu chuẩn bị thành công
if ($stmt) {
    // Gán giá trị cho các tham số
    $stmt->bind_param("ssssi", $fullname, $SalesmilestoneEdit, $completiontimeEdit, $KPIsEdit, $positionId);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        header("Location: /Web_quan_ly_nhan_su/admin/position/position.php");
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    // Đóng câu lệnh
    $stmt->close();
} else {
    echo "Lỗi: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
