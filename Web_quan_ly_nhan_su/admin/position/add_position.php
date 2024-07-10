<?php
// Nhận dữ liệu từ form
$fullname = $_POST['fullname'];
$Salesmilestone = $_POST['Salesmilestone'];
$completiontime = $_POST['completiontime'];
$KPIs = $_POST['KPIs'];
$Salesmilestone = str_replace('.', '', $Salesmilestone);
$completiontime = str_replace('.', '', $completiontime);
$KPIs = str_replace('.', '', $KPIs);

// Kết nối db
require_once 'conn_position.php';

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Viết lệnh SQL để thêm dữ liệu sử dụng prepared statements
$themsql = "INSERT INTO position (Name, Sales_milestone, completion_time, KPIs) VALUES (?, ?, ?, ?)";

// Chuẩn bị câu lệnh
$stmt = $conn->prepare($themsql);

// Kiểm tra nếu chuẩn bị thành công
if ($stmt) {
    // Gán giá trị cho các tham số
    $stmt->bind_param("ssss", $fullname, $Salesmilestone, $completiontime, $KPIs);

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
