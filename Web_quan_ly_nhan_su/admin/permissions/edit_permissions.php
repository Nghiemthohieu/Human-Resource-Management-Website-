<?php
    include "../includes/conn.php";
    $positionId = $_GET['id'];
    $privileges = mysqli_query($conn,"SELECT * FROM privitege");
    $privileges = mysqli_fetch_all($privileges,MYSQLI_ASSOC);
    $privilegeGroup= mysqli_query($conn,"SELECT * FROM `privitege_group` ORDER BY `arrange` ASC");
    $privilegeGroup = mysqli_fetch_all($privilegeGroup,MYSQLI_ASSOC);
    $currentPrivileges = mysqli_query($conn,"SELECT * FROM `user_privitege` WHERE position_id=$positionId");
    $currentPrivileges = mysqli_fetch_all($currentPrivileges,MYSQLI_ASSOC);
    $currentPrivilegeList = array();
    if(!empty($currentPrivileges)){
        foreach($currentPrivileges as $currentPrivilege)
        {
            $currentPrivilegeList[]= $currentPrivilege['privitege_id'];
        }
    }
    echo '<form action="update_permissions.php" method="post" id="Edit">';
    echo '<input type="hidden" id="positionIdEdit" name="positionId" value="'.$positionId.'">';
    foreach($privilegeGroup as $Group){
    echo '<div class="privilege-group">';
        echo '<h3 class="group-name">'.$Group['name'].'</h3>';
        echo '<ul>';
            foreach($privileges as $privilege){
                if($privilege['group_id']== $Group['ID']){
                $checked = in_array($privilege['ID'], $currentPrivilegeList) ? 'checked' : '';
                echo '<li>';
                    echo '<input type="checkbox" '.$checked.' value="'.$privilege['ID'].'" id="privilege_'.$privilege['ID'].'" name="privilege[]">';
                    echo '<label for="privilege_'.$privilege['ID'].'">'.$privilege['name'].'</label>';
                echo '</li>';
                }
            }
        echo '</ul>'; 
    echo '</div>';
    }
    echo '<div class="flex-container">';
            echo '<input type="submit" value="Lưu">';   
    echo '</div>';
    echo '</form>';
?>
