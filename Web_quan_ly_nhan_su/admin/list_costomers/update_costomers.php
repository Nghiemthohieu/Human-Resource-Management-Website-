<?php

//nhận dữ liệu từ form
// $ID_persition=$_POST['ID_persition'];
$listcostomersID= $_POST['listcostomersIdEdit'];
$fullname = $_POST['fullnameEdit'];
$Relationship = $_POST['RelationshipEdit'];
$Yearbirth = $_POST['YearbirthEdit'];
$school = $_POST['schoolEdit'];
$majors = $_POST['majorsEdit'];
$freetime = $_POST['freetimeEdit'];
$Address = $_POST['AddressEdit'];
$Problem = $_POST['ProblemEdit'];
$level = $_POST['levelEdit'];
$demand = $_POST['demandEdit'];
$phoneNumber = $_POST['phoneNumberEdit'];
$target = $_POST['targetEdit'];
$understanding = $_POST['understandingEdit'];
$circumstances = $_POST['circumstancesEdit'];
$opinion = $_POST['opinionEdit'];
$tuition = $_POST['tuitionEdit'];
$Note = $_POST['noteEdit'];
$studytime= $_POST['studytimeEdit'];
$concerned = $_POST['concernedEdit'];

if (substr($phoneNumber, 0, 1) === '0') {
    // Nếu bắt đầu bằng số 0, thay thế nó bằng mã quốc gia +84
    $phoneNumber = '+84' . substr($phoneNumber, 1);
}
//ket noi db
require_once 'conn_liscostomers.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql= "UPDATE list_customers SET 
            Name='$fullname',
            phoneNumber='$phoneNumber',
            Relationship='$Relationship',
            Year_birth='$Yearbirth',
            school='$school',
            majors='$majors',
            Address='$Address',
            free_time='$freetime',
            Problem='$Problem',
            level='$level',
            customer_need='$demand',
            Target='$target',
            Study_time='$studytime',
            level_understanding='$understanding',
            concerned='$concerned',
            family_circumstances='$circumstances',
            family_opinion='$opinion',
            family_tuition='$tuition',
            note='$Note' 
            WHERE ID= $listcostomersID";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);
if($result){
    header("location: /Web_quan_ly_nhan_su/admin/list_costomers/list_costomer.php");
}
?>