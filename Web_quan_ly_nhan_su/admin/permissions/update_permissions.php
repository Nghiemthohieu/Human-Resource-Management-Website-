<?php
    include "../includes/conn.php";
    $data=$_POST;
    $insertString = "";
    $deleteOldPrivilege=mysqli_query($conn,"DELETE FROM user_privitege WHERE position_id=".$data['positionId']."");
    foreach($data['privilege'] as $insertPrivilege){
        $insertString .= empty($insertString)?"" : ",";
        $insertString .= "(".$data['positionId'].",".$insertPrivilege.",'1716983332','1716983332')";
    }
    $insertPrivilege = mysqli_query($conn,"INSERT INTO user_privitege(position_id,privitege_id,created_time,last_update) VALUES ". $insertString);
    if ($insertPrivilege) {
        header("location: /Web_quan_ly_nhan_su/admin/permissions/permissions.php");
    }
?>