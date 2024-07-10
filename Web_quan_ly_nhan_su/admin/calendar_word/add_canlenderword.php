<?php
// Nhận dữ liệu từ form
$ID_personnal = $_POST['personnalId'];
$monday = $_POST['Monday'];
$tuesday = $_POST['Tuesday'];
$wednesday = $_POST['Wednesday'];
$thurday = $_POST['Thursday'];
$friday = $_POST['Friday'];
$saturday = $_POST['Saturday'];

// Tính toán các ngày trong tuần hiện tại
$startOfWeek = new DateTime();
$startOfWeek->setISODate((int)$startOfWeek->format('o'), (int)$startOfWeek->format('W')+ 1, 1); // Set to Monday of current week

$dates = [];
for ($i = 0; $i < 6; $i++) {
    $dates[] = $startOfWeek->format('Y-m-d');
    $startOfWeek->modify('+1 day');
}

// Kết nối db
require_once 'conn_calendarword.php';
// var_dump($dates[0]);
// var_dump($dates[1]);
// var_dump($dates[2]);
// var_dump($dates[3]);
// var_dump($dates[4]);
// var_dump($dates[5]);exit;
// Viết lệnh SQL để thêm dữ liệu
$themsql = "INSERT INTO calendar (ID_personnal, date, shift) VALUES 
            ($ID_personnal, '{$dates[0]}', '$monday'), 
            ($ID_personnal, '{$dates[1]}', '$tuesday'), 
            ($ID_personnal, '{$dates[2]}', '$wednesday'), 
            ($ID_personnal, '{$dates[3]}', '$thurday'), 
            ($ID_personnal, '{$dates[4]}', '$friday'), 
            ($ID_personnal, '{$dates[5]}', '$saturday')";

// Thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);
if ($result) {
    header("Location: /Web_quan_ly_nhan_su/admin/calendar_word/calendarword.php");
} else {
    echo "Error: " . $themsql . "<br>" . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
?>