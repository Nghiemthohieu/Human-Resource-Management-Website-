<?php
//nhận dữ liệu từ form
$fullname = $_POST['fullname'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$school = $_POST['school'];
$yearbirth = $_POST['yearbirth'];
$dbo = $_POST['dbo'];
$time = $_POST['time'];
$form = $_POST['form'];
$note = $_POST['note'];
$ID_personnal=$_POST['ID_personnal'];
$formatted_dob = date('Y-m-d', strtotime(str_replace('-', '/', $dbo)));
if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}
// Chuyển đổi định dạng thời gian
$time = date("H:i:s", strtotime($time));
//ket noi db
require_once 'conn_interview.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql= "INSERT INTO interview_schedule (Name,phonenumnar,mail,school,year_birth,date_interview,time_interview,form,Note,ID_personnal) VALUES ('$fullname','$phoneNumber','$email','$school','$yearbirth','$formatted_dob','$time','$form','$note','$ID_personnal');";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);
if($result){
    header("location: /Web_quan_ly_nhan_su/admin/interview_schedule/interview_schedule.php");
}
?>

