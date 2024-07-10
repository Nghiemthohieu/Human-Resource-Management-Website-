<?php
    include "conn_interview.php";

    // Lấy dữ liệu từ yêu cầu AJAX
    $data = json_decode(file_get_contents("php://input"), true);
    $Id = $data['Id'];
    $result = $data['result'];

    // Chuẩn bị câu truy vấn SQL
    $sql = "UPDATE interview_schedule SET result = ? WHERE ID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $result, $Id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo json_encode(["status" => "success"]);
?>