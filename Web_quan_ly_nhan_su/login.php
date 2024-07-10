<?php
session_start();
include '../Web_quan_ly_nhan_su/admin/includes/conn.php';
include './admin/funtion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['account-address'];
    $password = $_POST['password'];

    if ($stmt = $conn->prepare("SELECT ID_personnal, password,Name,ID_position, ID_status FROM personnal WHERE ID_personnal = ?")) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $stored_password,$name,$id_position,$id_status);
            $stmt->fetch();
            if ($password == $stored_password ) {
                if($id_status== 1 )
                {
                    $userPrivilages = mysqli_query($conn,"SELECT *
                    FROM user_privitege
                    INNER JOIN privitege
                    ON user_privitege.privitege_id=privitege.ID
                    WHERE user_privitege.position_id=$id_position");
                    $userPrivilages=mysqli_fetch_all($userPrivilages,MYSQLI_ASSOC);
                    if(!empty($userPrivilages))
                    {
                        $user['privileges'] = array();
                        foreach($userPrivilages as $privilage)
                        {
                            $user['privileges'][]=$privilage['url_match'];
                        }
                    }
                    $_SESSION['current_user'] = $user;
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['name'] = $name;
                    $_SESSION['idPosition'] = $id_position;
                    $_SESSION['login_message'] = "Đăng nhập thành công!";
                    $_SESSION['logged_in'] = true;
                    header("Location: /Web_quan_ly_nhan_su/admin/home/home.php");
                    exit;
                }
                else{
                    $_SESSION['login_message'] = "Tài khoản không tồn tại.";
                }
            } else {
                $_SESSION['login_message'] = "Mật khẩu không đúng.";
            }
        } else {
            $_SESSION['login_message'] = "Tài khoản không tồn tại.";
        }
        $stmt->close();
    } else {
        $_SESSION['login_message'] = "Lỗi trong truy vấn SQL.";
    }
}

$conn->close();
header("Location: index.php");
exit;
?>
