<?php
include('/xampp/htdocs/Web_quan_ly_nhan_su/vendor/autoload.php');
include('../bill/conn_bill.php');

use Smalot\PdfParser\Parser;

// Thiết lập giới hạn bộ nhớ và thời gian thực thi
ini_set('memory_limit', '256M');
set_time_limit(300);

// Kiểm tra xem file có được tải lên hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdfFile'])) {
    $fileTmpPath = $_FILES['pdfFile']['tmp_name'];
    $fileName = $_FILES['pdfFile']['name'];
    $uploadFileDir = './uploaded_files/';
    $dest_path = $uploadFileDir . $fileName;

    if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
    }

    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        // Đọc file PDF
        $parser = new Parser();
        $pdf = $parser->parseFile($dest_path);
        $text = $pdf->getText();

        // Chia từng dòng của văn bản
        $lines = explode("\n", $text);

        // Mảng để lưu trữ dữ liệu đã tách
        $data = [];

        foreach ($lines as $line) {
            // Bỏ qua các dòng không chứa dữ liệu cần thiết
            if (strpos($line, 'Mã N.Viên') !== false || empty(trim($line))) {
                continue;
            }

            // Sử dụng regular expression để tìm và tách dữ liệu từ dòng
            $pattern = '/^(\d+)\s+(.*?)\s+(.*?)\s+(.*?)\s+(\d{1,2}\/\d{1,2}\/\d{4})([^\d]*)(\d{1,2}:\d{2})?([^\d]*)(\d{1,2}:\d{2})?\s*(\d+)?/';
            if (preg_match($pattern, $line, $matches)) {
                $ID_personnal = $matches[1];
                $name = $matches[2];
                $Department = $matches[3];
                $position = $matches[4];
                $date = date('Y-m-d', strtotime($matches[5])); // Chuyển đổi ngày thành định dạng Y-m-d
                $day = trim($matches[6]);
                $check_in = isset($matches[7]) ? $matches[7] : null;
                $check_out = isset($matches[9]) ? $matches[9] : null;
                $work_hour = isset($matches[10]) ? floatval($matches[10]) : 0.0;

                // Lưu vào mảng dữ liệu
                $data[] = [
                    $ID_personnal,
                    $name,
                    $Department,
                    $position,
                    $date,
                    $day,
                    $check_in,
                    $check_out,
                    $work_hour,
                ];
            }
        }

        // Hiển thị dữ liệu để kiểm tra
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";exit;

        // Chuẩn bị câu lệnh SQL và chèn dữ liệu vào bảng MySQL
        $stmt = $conn->prepare("INSERT INTO  timekeeping(ID_personnal,name,Department,position,date,day,check_in,check_out,work_hour) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($data as $row) {
            $stmt->bind_param("issssssss", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
            $stmt->execute();
        }

        // Đóng kết nối
        $stmt->close();
        $conn->close();

        echo "Data successfully inserted into the database.";
        header("Location: /Web_quan_ly_nhan_su/admin/timekeeping/timekeeping.php");
        exit(); // Đảm bảo không có mã nào khác được thực thi sau header
    } else {
        echo "There was an error moving the uploaded file.";
    }
} else {
    echo "No file uploaded or invalid request.";
}
?>
