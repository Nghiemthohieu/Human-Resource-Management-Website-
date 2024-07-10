<?php
// Kết nối cơ sở dữ liệu
require_once 'conn.php';

// Kiểm tra xem có dữ liệu nhận được không
if (isset($_GET['id'])) {
    $personnalId = $_GET['id'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin nhân viên dựa trên ID
    $query = "SELECT personnal.*, position.name AS position_name, status.name AS status_name, teams.ID_teams AS ID_teams FROM personnal JOIN position ON personnal.ID_position = position.ID JOIN status ON personnal.ID_status = status.ID JOIN teams ON personnal.ID_personnal=teams.ID_personnal WHERE personnal.ID_personnal='$personnalId';";
    $result = mysqli_query($conn, $query);

    // Kiểm tra xem có kết quả trả về không
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Trả về dữ liệu dưới dạng JSON
        echo json_encode($row);
    } else {
        // Trường hợp không tìm thấy nhân viên
        echo json_encode(['error' => 'Không tìm thấy thông tin nhân viên']);
    }
} else {
    // Trường hợp không có dữ liệu nhận được
    echo json_encode(['error' => 'Không nhận được dữ liệu nhân viên']);
}

?>