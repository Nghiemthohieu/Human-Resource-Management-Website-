<?php

//nhận dữ liệu từ form
$fullname = $_POST['fullnameEdit'];
$productId = $_POST['productId'];
//ket noi db
require_once 'conn_product.php';

//viết lệnh sql để thêm dữ liệu
$updatesql = "UPDATE product SET name ='$fullname' WHERE ID=$productId"; // Đã sửa ở đây
// Đã sửa ở đây, bạn có thể thêm exit nếu cần
//thực thi câu lệnh thêm
$result = mysqli_query($conn, $updatesql);
if ($result) {
    header("location: /Web_quan_ly_nhan_su/admin/product/product.php");
}
?>
