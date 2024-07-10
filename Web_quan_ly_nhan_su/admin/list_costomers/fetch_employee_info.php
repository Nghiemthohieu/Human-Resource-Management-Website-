<?php
    //ketnoi
    session_start();
   include '../funtion.php';
    require_once 'conn_liscostomers.php';
        $idPersonnal= htmlspecialchars($_SESSION['user_id']);
        $selected_id_personnal = isset($_GET['idPersonnal']) ? $_GET['idPersonnal'] : $idPersonnal;
        //caulenh
        $listcostomers_sql = "SELECT * FROM `list_customers` WHERE ID_personnal=$selected_id_personnal ORDER BY `list_customers`.`ID` DESC;";
        //thuc thi cau lenh
        $result=mysqli_query($conn, $listcostomers_sql);
        //duyet qua result và in ra
        while($r = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td data-column="1"><?php echo $r['ID'];?></td>
                    <td data-column="20"><?php echo $r['ID_personnal'];?></td>
                    <td data-column="2"><?php echo $r['Name'];?></td>
                    <td data-column="21"><?php echo $r['phoneNumber'];?></td>
                    <td data-column="3"><?php echo $r['Relationship'];?></td>
                    <td data-column="4"><?php echo $r['Year_birth'];?></td>
                    <td data-column="5"><?php echo $r['school'];?></td>
                    <td data-column="6"><?php echo $r['majors'];?></td>
                    <td data-column="7"><?php echo $r['Address'];?></td>
                    <td data-column="8"><?php echo $r['free_time'];?></td>
                    <td data-column="9"><?php echo $r['Problem'];?></td>
                    <td data-column="10"><?php echo $r['level'];?></td>
                    <td data-column="11"><?php echo $r['customer_need'];?></td>
                    <td data-column="12"><?php echo $r['Target'];?></td>
                    <td data-column="13"><?php echo $r['Study_time'];?></td>
                    <td data-column="14"><?php echo $r['level_understanding'];?></td>
                    <td data-column="15"><?php echo $r['concerned'];?></td>
                    <td data-column="16"><?php echo $r['family_circumstances'];?></td>
                    <td data-column="17"><?php echo $r['family_opinion'];?></td>
                    <td data-column="18"><?php echo $r['family_tuition'];?></td>
                    <td data-column="19"><?php echo $r['note'];?></td>
                    <td class="button">
                        <?php if(checkPrivilege('information_listcostomers.php?id=0')) { ?>
                        <button>
                            <i class="fa-solid fa-address-card icon" ></i>
                        </button>
                        <?php } ?>
                        <?php if(checkPrivilege('edi_costomers.php?id=0')) { ?>
                        <button class="editButton" data-id="<?php echo $r['ID']; ?>">
                            <i class="fa-solid fa-pen-to-square icon"></i>
                        </button>
                        <?php } ?>
                        <?php if(checkPrivilege('remove_costomers.php?id=0')) { ?>
                        <button>
                            <a onclick="return confirm('bạn có muốn xóa nhân sự này không');" href="remove_costomers.php?sid=<?php echo $r['ID']; ?>"><i class="fa-solid fa-user-minus icon"></i></a> 
                        </button>
                        <?php } ?>
                    </td>
                </tr>
            <?php
        }
?>