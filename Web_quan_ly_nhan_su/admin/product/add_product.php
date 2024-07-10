<?php
//nhận dữ liệu từ form
$fullname = $_POST['fullname'];
//ket noi db
require_once 'conn_product.php' ;

//viết lệnh sql để thêm dữ liệu
$themsql= "INSERT INTO product (Name) VALUES ('$fullname')";
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $themsql);
if($result){
    header("location: /Web_quan_ly_nhan_su/admin/product/product.php");
}
?>
