<?php
    //lay du lieu id can xoa
    $id = $_GET['sid'];
    // echo $id;
    require_once ('conn_position.php');
    $xoa_sql = "Delete from position where ID=$id";
    if(mysqli_query($conn,$xoa_sql)){
        header("location: /Web_quan_ly_nhan_su/admin/position/position.php");
    }else {
        echo "Lỗi dữ liệu." ;
    }
    // echo "<h1>xoa thanh cong</h>"
?>