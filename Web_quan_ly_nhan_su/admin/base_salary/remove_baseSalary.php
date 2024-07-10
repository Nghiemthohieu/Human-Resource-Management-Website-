<?php
    //lay du lieu id can xoa
    $id = $_GET['sid'];
    // echo $id;
    require_once ('conn_baseSalary.php');
    $xoa_sql = "Delete from base_salary where ID=$id";
    if(mysqli_query($conn,$xoa_sql)){
        header("location: /Web_quan_ly_nhan_su/admin/base_salary/base_salary.php");
    }
    // echo "<h1>xoa thanh cong</h>"

?>