<?php
header('Content-Type: application/json');

require_once 'conn_statistical.php' ;

// Lấy năm từ yêu cầu GET
$year = $_GET['year'];

// Truy vấn MySQL để lấy doanh số kinh doanh cho năm đã chọn
$sql = "SELECT MONTH(bill.Registration_Date) AS month, SUM(bill.pay_money) AS total_sales 
            FROM bill 
            WHERE YEAR(bill.Registration_Date) = $year 
            GROUP BY MONTH(bill.Registration_Date)
            ORDER BY month";

$result = mysqli_query($conn, $sql);

// Tạo mảng 12 phần tử với giá trị mặc định là 0 cho doanh số
$data = array_fill(0, 12, 0);

while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['month'] - 1] = (float) $row['total_sales'];
}

echo json_encode($data);

?>
