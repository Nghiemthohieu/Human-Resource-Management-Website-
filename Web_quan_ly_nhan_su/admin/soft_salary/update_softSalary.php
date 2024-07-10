<?php
//nhận dữ liệu từ form
$softSalary=$_POST['softSalary_ID'];
$position = $_POST['positionEdit'];
$carePart1 = $_POST['carePart1Edit'];
$target1 = $_POST['target1Edit'];
$carePart2 = $_POST['carePart2Edit'];
$target2 = $_POST['target2Edit'];
$carePart3 = $_POST['carePart3Edit'];
$target1 = str_replace('.', '', $target1);
$target2 = str_replace('.', '', $target2);
//ket noi db
require_once 'conn_softSalary.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql= "UPDATE `soft_salary` SET ID_position='$position',care_part_1='$carePart1',target_1='$target1',care_part_2='$carePart2',target_2='$target2',care_part_3='$carePart3' WHERE ID = $softSalary";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);
if($result){
    header("location: /Web_quan_ly_nhan_su/admin/soft_salary/soft_salary.php");
}
?>
