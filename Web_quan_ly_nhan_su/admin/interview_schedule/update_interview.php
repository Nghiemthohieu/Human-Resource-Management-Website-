<?php

//nhận dữ liệu từ form
$fullname = $_POST['fullnameEdit'];
$phoneNumber = $_POST['phoneNumberEdit'];
$email = $_POST['emailEdit'];
$school = $_POST['schoolEdit'];
$yearbirth = $_POST['yearbirthEdit'];
$dbo = $_POST['dboEdit'];
$time = $_POST['timeEdit'];
$form = $_POST['formEdit'];
$note = $_POST['noteEdit'];
$ID = $_POST['interviewId'];
$formatted_dob = date('Y-m-d', strtotime(str_replace('-', '/', $dbo)));
if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}
// Chuyển đổi định dạng thời gian
$time = date("H:i:s", strtotime($time));
//ket noi db
require_once 'conn_interview.php';

//viết lệnh sql để thêm dữ liệu
$updatesql = "UPDATE interview_schedule SET Name='$fullname', phonenumnar='$phoneNumber', 	mail='$email', school='$school', year_birth='$yearbirth', date_interview='$formatted_dob', time_interview='$time', form='$form', Note='$note' WHERE ID=$ID"; // Đã sửa ở đây
// Đã sửa ở đây, bạn có thể thêm exit nếu cần
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $updatesql);
if ($result) {
    header("location: /Web_quan_ly_nhan_su/admin/interview_schedule/interview_schedule.php");
}
?>
