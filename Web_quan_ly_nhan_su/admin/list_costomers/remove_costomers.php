<?php
    //lay du lieu id can xoa
    $id = $_GET['sid'];
    // echo $id;
    require_once ('conn_liscostomers.php');
    $xoa_sql = "Delete from list_customers where ID=$id";
    if(mysqli_query($conn,$xoa_sql)){
        header("location: /Web_quan_ly_nhan_su/admin/list_costomers/list_costomer.php");
    }
    // echo "<h1>xoa thanh cong</h>"

?>