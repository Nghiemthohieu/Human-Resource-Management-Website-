<?php
//nhận dữ liệu từ form
$position = $_POST['position'];
$carePart1 = $_POST['carePart1'];
$target1 = $_POST['target1'];
$carePart2 = $_POST['carePart2'];
$target2 = $_POST['target2'];
$carePart3 = $_POST['carePart3'];
$target1 = str_replace('.', '', $target1);
$target2 = str_replace('.', '', $target2);
//ket noi db
require_once 'conn_baseSalary.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql= "INSERT INTO base_salary (ID_position,care_part_1,target_1,care_part_2,target_2,care_part_3) VALUES ('$position','$carePart1','$target1','$carePart2','$target2','$carePart3')";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);
if($result){
    header("location: /Web_quan_ly_nhan_su/admin/base_salary/base_salary.php");
}
?>
