<?php
    include "conn.php";

    // Lấy dữ liệu từ yêu cầu AJAX
    $data = json_decode(file_get_contents('php://input'), true);
    $personId = $data['personId'];
    $status = $data['status'];

    // Chuẩn bị câu truy vấn SQL
    $sql = "UPDATE personnal SET ID_status = ? WHERE id_personnal = ?";

    // Chuẩn bị và ràng buộc
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $personId);

    // Thực thi câu truy vấn
    if ($stmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Đóng kết nối
    $stmt->close();
    $conn->close();
?>