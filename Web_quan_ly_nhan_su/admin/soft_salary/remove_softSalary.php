<?php
    //lay du lieu id can xoa
    $id = $_GET['sid'];
    // echo $id;
    require_once ('conn_softSalary.php');
    $xoa_sql = "Delete from soft_salary where ID=$id";
    if(mysqli_query($conn,$xoa_sql)){
        header("location: /Web_quan_ly_nhan_su/admin/soft_salary/soft_salary.php");
    }
    // echo "<h1>xoa thanh cong</h>"

?>