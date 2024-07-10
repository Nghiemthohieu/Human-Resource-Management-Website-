<?php
    //lay du lieu id can xoa
    $id = $_GET['sid'];
    // echo $id;
    require_once ('conn_interview.php');
    $xoa_sql = "Delete from interview_schedule where ID=$id";
    if(mysqli_query($conn,$xoa_sql)){
        header("location: /Web_quan_ly_nhan_su/admin/interview_schedule/interview_schedule.php");
    }
    // echo "<h1>xoa thanh cong</h>"

?>