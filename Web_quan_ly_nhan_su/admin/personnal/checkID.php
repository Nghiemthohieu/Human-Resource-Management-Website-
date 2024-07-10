<?php
// Kết nối cơ sở dữ liệu
require_once 'conn.php';

// Kiểm tra xem có dữ liệu nhận được không
if (isset($_POST['key'])) {
    $key = $_POST['key'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin nhân viên dựa trên ID
    $query = $conn->prepare("SELECT * FROM personnal WHERE ID_personnal = ?");
    $query->bind_param('s', $key);
    $query->execute();
    $result = $query->get_result();

    // Kiểm tra xem có kết quả trả về không
    if ($result && mysqli_num_rows($result) == 0) {
        // Trả về dữ liệu dưới dạng JSON
        echo json_encode('ok');
    } else {
        // Trường hợp không tìm thấy nhân viên
        echo json_encode(['error' => 'mã key trùng']);
    }
} else {
    // Trường hợp không có dữ liệu nhận được
    echo json_encode(['error' => 'Không nhận được dữ liệu.']);
}
?>
