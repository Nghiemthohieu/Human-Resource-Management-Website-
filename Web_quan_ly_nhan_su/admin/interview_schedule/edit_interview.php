<?php
// Kết nối cơ sở dữ liệu
require_once 'conn_interview.php';

// Kiểm tra xem có dữ liệu nhận được không
if (isset($_GET['id'])) {
    $interviewId = $_GET['id'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin nhân viên dựa trên ID
    $query = "SELECT * FROM interview_schedule where ID=$interviewId";
    $result = mysqli_query($conn, $query);

    // Kiểm tra xem có kết quả trả về không
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Trả về dữ liệu dưới dạng JSON
        echo json_encode($row);
    } else {
        // Trường hợp không tìm thấy nhân viên
        echo json_encode(['error' => 'Không tìm thấy thông tin ']);
    }
} else {
    // Trường hợp không có dữ liệu nhận được
    echo json_encode(['error' => 'Không nhận được dữ liệu ']);
}

?>