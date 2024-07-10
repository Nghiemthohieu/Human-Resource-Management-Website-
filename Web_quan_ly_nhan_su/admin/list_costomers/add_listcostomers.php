<?php

//nhận dữ liệu từ form
$ID_persition=$_POST['personnal_ID'];
$fullname = $_POST['fullname'];
$Relationship = $_POST['Relationship'];
$Yearbirth = $_POST['Yearbirth'];
$school = $_POST['school'];
$majors = $_POST['majors'];
$freetime = $_POST['freetime'];
$Address = $_POST['Address'];
$Problem = $_POST['Problem'];
$level = $_POST['level'];
$demand = $_POST['demand'];
$phoneNumber = $_POST['phoneNumber'];
$target = $_POST['target'];
$understanding = $_POST['understanding'];
$circumstances = $_POST['circumstances'];
$opinion = $_POST['opinion'];
$tuition = $_POST['tuition'];
$Note = $_POST['note'];
$studytime= $_POST['studytime'];
$concerned = $_POST['concerned'];

if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}
//ket noi db
require_once 'conn_liscostomers.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql= "INSERT INTO list_customers (Name,Relationship,Year_birth,school,majors,Address,free_time,Problem,level,customer_need,Target,Study_time,level_understanding,concerned,family_circumstances,family_opinion,family_tuition,note,phoneNumber,ID_personnal) VALUES ('$fullname','$Relationship','$Yearbirth','$school','$majors','$Address','$freetime','$Problem','$level','$demand','$target','$studytime','$understanding','$concerned','$circumstances','$opinion','$tuition','$Note','$phoneNumber','$ID_persition')";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);
if($result){
    header("location: /Web_quan_ly_nhan_su/admin/list_costomers/list_costomer.php");
}
?>

