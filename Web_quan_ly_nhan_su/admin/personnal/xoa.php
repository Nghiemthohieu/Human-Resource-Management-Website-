<?php
    //lay du lieu id can xoa
    $id = $_GET['sid'];
    // echo $id;
    require_once ('conn.php');
    $xoa_sql = "Delete from personnal where id_personnal=$id";
    if(mysqli_query($conn,$xoa_sql)){
        header("location: /Web_quan_ly_nhan_su/admin/personnal/personnal.php");
    }
    // echo "<h1>xoa thanh cong</h>"

?>