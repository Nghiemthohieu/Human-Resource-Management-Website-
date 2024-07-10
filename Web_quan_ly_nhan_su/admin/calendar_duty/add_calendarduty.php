<?php
    $date=$_POST['date'];
    $shift=$_POST['shift'];
    $ID_personnal = $_POST['personnalId'];
    // var_dump($date);
    // var_dump($shift);
    // var_dump($ID_personnal);exit;
    require_once 'conn_calendardyty.php';

    $themsql = "INSERT INTO dutyschedule (ID_personnal, date, shift) VALUES 
                ($ID_personnal, '$date', '$shift')";
    // Thực thi câu lệnh thêm
    $result = mysqli_query($conn, $themsql);
    if ($result) {
        header("Location: /Web_quan_ly_nhan_su/admin/calendar_duty/calendar_duty.php");
    } else {
        echo "Error: " . $themsql . "<br>" . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);
?>