<?php
    //lay du lieu id can xoa
    $id = $_GET['sid'];
    // echo $id;
    require_once ('conn_product.php');
    $xoa_sql = "Delete from product where ID=$id";
    if(mysqli_query($conn,$xoa_sql)){
        header("location: /Web_quan_ly_nhan_su/admin/product/product.php");
    }
    // echo "<h1>xoa thanh cong</h>"
?>