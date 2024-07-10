<?php

//nhận dữ liệu từ form
$fullname = $_POST['fullnameEdit'];
$code = $_POST['codeEdit'];
$office = $_POST['officeEdit'];
$startDate = $_POST['startDateEdit'];
$position = $_POST['positionEdit'];
$hometown = $_POST['hometownEdit'];
$dob = $_POST['dobEdit'];
$gender = $_POST['genderEdit'];
$avatar = $_POST['avatarEdit'];
$email = $_POST['emailEdit'];
$phoneNumber = $_POST['phoneNumberEdit'];
$formatted_startDate = date('Y-m-d', strtotime(str_replace('-', '/', $startDate)));
$formatted_dob = date('Y-m-d', strtotime(str_replace('-', '/', $dob)));
$personnalId = $_POST['personnalId']; // Đã sửa ở đây
if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}
//ket noi db
require_once 'conn.php';

//viết lệnh sql để thêm dữ liệu
$updatesql = "UPDATE personnal SET name='$fullname', ID_position='$position', office='$office', startword='$formatted_startDate', hometown='$hometown', phonenumber='$phoneNumber', birthday='$formatted_dob', gender='$gender', mail='$email' WHERE ID_personnal=$personnalId"; // Đã sửa ở đây
// Đã sửa ở đây, bạn có thể thêm exit nếu cần
$updatesql1="UPDATE teams SET ID_teams='$code' where ID_personnal= $personnalId";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $updatesql);
$result =mysqli_query($conn,$updatesql1);
if ($result) {
    header("location: /Web_quan_ly_nhan_su/admin/personnal/personnal.php");
}
?>
