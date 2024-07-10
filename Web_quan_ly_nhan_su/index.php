<?php
session_start();
// Kiểm tra xem người dùng đã đăng nhập hay chưa
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: /Web_quan_ly_nhan_su/admin/home/home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./admin/font/fontawesome-free-6.5.1-web/css/all.min.css">
    <title>index</title>
    <style>
        /* CSS của bạn */
        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F7F1FF;
            position: relative;
        }

        .container {
            position: relative;
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 500px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .div1, .div2 {
            position: absolute;
            border-radius: 25px;
        }

        .div1 {
            background-color:  #FD8484;
            top: 18px;
            left: 160px;
            width: 138px;
            height: 210px;
        }

        .div2 {
            background-color: #A09EFF;
            bottom: -10px;
            right: 101px;
            width:  200px;
            height: 256px;
        }

        .img {
            flex: 1;
            margin-right: 0px;
        }

        .img img {
            width: 100%;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .login {
            flex: 1.5;
            margin-left: 10px;
        }

        .login h2 {
            margin-bottom: 30px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 30px;
            text-align: center;
        }

        .text-box {
            position: relative;
            margin-bottom: 24px;
        }

        .text-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding-left: 10px;
            padding-right: 40px;
        }

        .text-box i {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            color: #7a7a7a;
            font-size: 18px;
            transition: .3s;
        }

        .text-box input:focus ~ i,
        .text-box input:valid ~ i {
            color: #3498db;
            transform: translateY(-50%) scale(1.2);
        }

        .login-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #F7604C;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }

        .forgot-password {
            color: #3498db;
            text-align: center;
            margin-top: 10px;
            cursor: pointer;
        }
        p{
            font-size: 12px;
            color: #3498db;
            padding-left:8px ;
            margin-bottom: 0;
        }
        .text-box.password {
            margin-bottom: 5px; /* Mặc định */
        }
        .text-box.password.error {
            margin-bottom: 5px; /* Khi có lỗi */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="div1"></div>
        <div class="div2"></div>
        <div class="login-box">
            <div class="img">
                <img src="./admin/img/423541921_790911812891306_3105674440246969177_n.jpg" alt="UNI ENGLISH CENTER" width="100" height="345">
            </div>
            <div class="login">
                <h2>Đăng nhập</h2>
                <form action="./login.php" method="post">   
                    <div class="text-box">
                        <i class="fas fa-user"></i>
                        <input type="text" name="account-address" placeholder="Tài khoản" required
                               value="">
                    </div>
                    <div class="text-box password" >
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Mật khẩu" required>
                    </div>
                    <?php
                        if (isset($_SESSION['login_message'])) {
                            echo "<p>" . $_SESSION['login_message'] . "</p>";
                            unset($_SESSION['login_message']); // Xóa thông báo sau khi hiển thị
                        }
                    ?>
                    <input type="submit" value="Đăng nhập">
                </form>
                <div class="forgot-password">Quên mật khẩu?</div>
            </div>
        </div>
    </div>
     <!-- jQuery library -->
     <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

     <!-- Popper JS -->
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 
     <!-- Latest compiled JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
