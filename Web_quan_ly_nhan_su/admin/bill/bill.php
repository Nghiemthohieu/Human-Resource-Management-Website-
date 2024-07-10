<?php
session_start();
include '../funtion.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: /Web_quan_ly_nhan_su/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../font/fontawesome-free-6.5.1-web/css/all.min.css">
    <style>
        select {
            width: 90px;
            -webkit-appearance: none; 
            -moz-appearance: none;
            appearance: none;
            padding-right: 30px;
            background-image: url('../img/caret-down.png'); 
            background-repeat: no-repeat;
            background-position: calc(100% - 10px) center;
            background-size: 15px;
            padding: 5px;
            border-radius: 15px;
            position: relative;
            border: none;
            background-color: #D9D9D9;
            color: #5D5959;
        }
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
            background-color: #f7f1ff;
        }

        .overlay {
          background: linear-gradient(#2e1eec 20%, #FF0000 100%);
          border-radius: 30px;
          position: absolute;
          left: 9%;
          width: 12%;
          height: 640px;
          z-index: 1;
        }

        .login-box {
            display: flex;
            justify-content: space-between;
            width: 75%;
            height: 560px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border-radius: 15px;
            position: relative;
            z-index: 2;
            align-items: stretch;
        }

        .avatar-menu {
            border-top-left-radius: 15px ;
            border-bottom-left-radius: 15px;
            flex: 2;
            display: flex;
            height: 100%;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            background-color: #F7F1FF;
        }

        .avatar {
            flex: 1;
            margin-right: 0px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 25px;
        }

        .avatar-img {
            flex: 1;
            display: flex;
        }

        .avatar-name {
            flex: 1;
            font-size: 10px;
            padding-left: 10px;
            font-weight: bold;
        }
        ::-webkit-scrollbar{
            width: 5px;
        }
        ::-webkit-scrollbar-thumb{
            background-color: grey;
        }
        .avatar-name p {
          margin: 3px 0px;
        }
        .menu-box {
            flex: 8;
        }
        .menu{
          height: 378px;
          overflow-y: scroll;
          max-height: calc(100%);
        }

        .log-out button{
          top: 19px;
          border-bottom-left-radius: 15px;
        }
        .menu-box button {
            width: 100%;
            background-color: #F7F1FF;
            border: none;
            padding: 18px 0px;
            color: #000;
            position: relative;
            overflow: hidden;
            text-align: left;
            align-items: center;
            font-family: sans-serif;
            padding-left: 30px;
            color: #5D5959;
        }

        .menu-box button::after {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 5px;
            height: 80%;
            background: linear-gradient(#090076 10%, #FF0000 100%);
            background-color: rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s, width 0.3s;
            left: 100%;
            transform: translateY(10%);
        }
        .menu-box button:hover{
            color: #000;
        }
        .menu-box button:hover::after {
            opacity: 1;
            width: 3%;
            border-radius: 10px;
            left: 20px;
        }

        .menu-box button i {
            padding-right: 10px;
            width: 20px;
            text-align: center;
        }
        .menu-box button span{
            font-weight: bold;
            padding-left: 5px;
            font-family: sans-serif;
            font-size: 12px;
        }

        .avatar-menu img {
            width: 60px;
            height: 60px;
            border-radius: 50px;
        }

        .display {
            display: flex;
            flex-direction: column;
            width: 100%;
            flex: 8;
        }

        .display-header {
          display: flex;
          align-items: center;
          justify-content: flex-start;
          position: relative;
          flex: 2;
          background-color: #ffffff;
          padding: 0px 20px;
          border-top-right-radius: 15px;
          
        }

        .display-header h2 {
            margin: 0;
        }

        .display-body {
            display: flex;
            flex: 8;
            background-color: #ffffff;
            padding: 10px;
            border-bottom-right-radius: 15px;
            height: 100px;
        }
        .display-body #monthSelect{
            margin-left: 10px;
        }
        .display-body #yearSelect{
            width: 70px;
        }
        .display-body .button {
            display: flex;
        }
        table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
            font-weight: bold;
        }
        th, td {
            padding: 5px;
            text-align: center;
            font-size: 12px;
            font-family: Arial;
        }
        th{
            color: #585757;
        }
        .display-body button{
            padding: 5px;
            border: none;
            border-radius: 5px;
            display: flex;
            align-items: center;
            background-color: #ffffff;
            position: relative; /* Đặt vị trí của button là tương đối */
            overflow: hidden; /* Ẩn phần dải màu vượt ra ngoài phần button */
        }
        .display-body button i {
            margin-right: 5px;
            
        }
        .display-body button i.icon {
            font-size: 20px; /* Chỉnh kích thước của icon */
            color: #74C0FC;
        }
        .display-body button:hover i.icon {
            color: #e46d6d; /* Màu mới của icon khi hover */
        }
        .search-container {
            display: flex;
            align-items: center;
            padding: 0px 5px; /* Padding để tạo khoảng cách giữa border và nội dung */
            border: 1px solid #000000; /* Border mặc định */
            box-sizing: border-box; /* Đảm bảo rằng border sẽ được tính vào kích thước toàn bộ của phần tử */
            transition: width 0.3s; /* Thời gian chuyển đổi cho width */
            border-radius: 20px;
        }

        #searchInput {
            display: none; /* Ẩn ô nhập liệu ban đầu */
            border: none; /* Loại bỏ border cho ô nhập liệu */
            height:30px;
            outline: none; /* Loại bỏ đường viền khi focus */
        }
        #searchButton{
            height: 30px;
            border-radius: 10px;
        }

        button {
            border: none; /* Loại bỏ border cho nút "Tìm kiếm" */
        }
        .display-body .search{
            display: flex;
            justify-content: flex-end;
            margin-right: 50px;
            align-items: center;
        }
        .button-add button {
            /* border: 1px solid #000000; */
            border-radius: 8px;
            padding: 5px 10px;
            margin-left: 10px;
            background-color: #F85039;
        }
        .button-add button i.icons{
            border: 2px solid #000000;
            border-radius: 15px;
            padding: 2px 3px;
        }
        .button-add button:hover{
            background-color: #f85039ad;
        }

        .display-body .table {
            margin: 10px;
            height: 75%;
            overflow-y: auto;
            max-height: calc(100% - 70px);
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            font-family: Roboto, 'Droid Sans', Helvetica, sans-serif;
            font-size: 14px;
        }

        /* Nội dung phông */
        .modal-content {
            background-color: #fefefe;
            position: fixed;
            top: 2%;
            left: 20%;
            transform: translate(-50%, -50%);
            border: 1px solid #888;
            width: 60%;
            /* height: 80%; */
            display: flex;
            flex-direction: column;
            transform: scale(0); /* Bắt đầu ẩn modal */
            transform-origin: center; /* Đặt trung tâm xoay tại giữa */
            animation: zoomIn 1.5s forwards; /* Sử dụng hiệu ứng zoomIn */
            border-radius: 10px;
        }

        /* Đóng nút */
        .close {
            color: #818181;
            font-size: 24px;
            align-self: center; /* Đặt nút close ở giữa theo chiều dọc */
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            background-color: #c2c1c1;
        }

        /* Các dòng nhập thông tin */
        .modal-content form {
            margin-top: 20px; /* Thêm margin-top để tạo khoảng cách giữa nút close và form */
        }
        .modal-content-close {
            height: 40px; /* Thiết lập chiều cao */
            display: flex;
            align-items: center; /* Đặt nút close ở giữa theo chiều dọc */
            justify-content: space-between; /* Đặt nút close ở giữa theo chiều ngang */
            background-color: #d2d2d2;
            border-bottom: 1px solid #2b2b2b;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .modal-content-close button
        {
            padding: 0px 7px;
            margin-right: 10px;
            border: none;
            background-color: #d2d2d2;
        }
        .modal-content-close button:hover{
            color: #585757;
            background-color: #afafaf;
        }
        .modal-content-form {
            padding: 0px 10px 10px 10px;
            /* padding-top: 10px; */
            overflow-y: auto; /* Thêm thanh lướt xuống theo trục y khi nội dung vượt quá kích thước của modal-content-form */
            max-height: 100%; /* Đặt chiều cao tối đa cho modal-content-form, điều này sẽ kích hoạt thanh lướt xuống khi nội dung vượt quá */
            display: flex;
            flex-direction: column;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0); /* Ban đầu ẩn modal */
            }
            to {
                transform: scale(1); /* Hiển thị modal */
            }
        }

        .modal-content-close .text-add{
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px; /* Khoảng cách giữa text-add và nút đóng */
        }
        .modal-content-close .text-edit{
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px; /* Khoảng cách giữa text-add và nút đóng */
        }

        .modal-content-form input{
            width: 100%;
            height: 29px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            display: none;
        }
        /* Đặt flex-direction mặc định là row */
        .flex-container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
        .flex-item1, .flex-item2, .flex-item3 {
            flex: 1; /* Chia diện tích đều nhau */
            margin: 0px 10px 10px 10px;
            align-self: center; /* Để căn giữa */
        }
        .modal-content-form input[type="submit"] {
            width: 20%;
            margin-left: 40%;
            border-radius: 5px;
        }
        .modal-content-form input[type="submit"]:hover{
            background-color: #818181;
        }
        /* Khi màn hình nhỏ hơn hoặc bằng 600px, đặt flex-direction là column cho mỗi phần tử */
        
        .modal-content-form input[type="date"] {
            height: 29px;
            box-sizing: border-box;
        }
        .modal-content-form select{
            width: 100%;
            height: 29px;
            background-color: #fff;
        }
        .modal-content-form input[type="text"] {
            box-sizing: border-box;
            width: 100%; /* Thiết lập chiều rộng của input */
        }
        .modal-content-form input[type="tel"]
        {
            box-sizing: border-box;
        }
        .modal-content-form input[type="email"]{
            box-sizing: border-box;
        }
        .modal-content-form input,
        .modal-content-form select {
            margin-top: 5px; /* Tạo khoảng cách giữa label và input */
            border: 1px solid #8b8a8a;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
        }
        .modal-content-form input[type="file"]{
            padding: 0px;
        }
        .modal-content-form input[type="checkbox"]{
            width: 15px;
            height: 15px;
            border: #000 solid #000;
            margin: 0px 10px;
        }
        .btn-setting{
            margin-left: 10px ;
        }
        .btn-setting i.icon{
            color: #818181;
            font-size: 22px;
        }
        .btn-setting i.icon:hover{
            color: #818181a6;
        }
        .form-setting{
            flex:2;
            height: 100%;
            overflow-y: auto;
            font-size: 14px;
            display: none;
        }
        .form-setting input{
            margin-right: 8px;
        }
        .display-body-home{
            flex: 8;
        }
        .flex-container textarea{
            width: 100%;
            height: 50px;
        }
        .pagination {
            text-align: center;
            padding: 10px 0;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd0;
            font-size: 12px;
        }

        .pagination a:hover {
            background-color: #f1f1f1;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
    </style>
</head>
<body>
<div class="overlay"></div>
<div class="login-box">
    <div class="avatar-menu">
        <div class="avatar">
            <div class="avarta-img">
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/information/information.php'">
                    <img src="../img/423541921_790911812891306_3105674440246969177_n.jpg" alt="avarta">
                </button>
            </div>
            <div class="avatar-name">
                <p><?php echo htmlspecialchars($_SESSION['name']); ?></p>
                <p><?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
            </div>
        </div>
        <div class="menu-box">
            <div class="menu">
                <?php if(checkPrivilege('home.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/home/home.php'">
                    <i class="fa-solid fa-house" ></i>
                    <span>Trang chủ</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('salary.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/salary/salary.php'">
                    <i class="fa-solid fa-sack-dollar"></i>
                    <span>Lương</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('position.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/position/position.php'">
                    <i class="fa-solid fa-briefcase" ></i>
                    <span>Chức vụ</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('statistical.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/statistical/statistical.php'">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Thống kê</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('personnal.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/personnal/personnal.php'">
                    <i class="fa-solid fa-users"></i>
                    <span>Nhân sự</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('calendarword.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/calendar_word/calendarword.php'">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Lịch làm</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('calendar_duty.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/calendar_duty/calendar_duty.php'">
                    <i class="fa-solid fa-calendar-week"></i>
                    <span>Lịch trực</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('list_costomer.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/list_costomers/list_costomer.php'">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>lập DSKH</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('interview_schedule.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/interview_schedule/interview_schedule.php'">
                    <i class="fa-solid fa-user-group"></i>
                    <span>Lịch phỏng vấn</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('bill.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/bill/bill.php'">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>Bill</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('costomers.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/costomers/costomers.php'">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Khách hàng</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('soft_salarys.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/soft_salary/soft_salary.php'">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    <span>Phần trăm lương mềm</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('base_salary.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/base_salary/base_salary.php'">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    <span>Phần trăm lương cứng</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('product.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/product/product.php'">
                    <i class="fa-brands fa-shopify"></i>
                    <span>sản phẩm</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('permissions.php')) { ?>
                <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/timekeeping/timekeeping.php'">
                    <i class="fa-brands fa-shopify"></i>
                    <span>chấm công</span>
                </button>
                <?php } ?>
                <?php if(checkPrivilege('timekeeping.php')) { ?>
                    <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/permissions/permissions.php'">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Phân quyền</span>
                    </button>
                <?php } ?>
            </div>
            <div class="log-out" >
                <button onclick="confirmLogout()">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>log out</span>
              </button>
            </div>
        </div>
    </div>
    <div class="display">
        <div class="display-header">
          <h2>Hóa đơn</h2>
        </div>
        <div class="display-body">
            <div class="display-body-home">
                <div class="search">
                    <div class="search-container" id="searchContainer">
                        <button id="searchButton" onclick="toggleSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
                        <input type="text" id="searchInput" placeholder="Nhập từ khóa">
                    </div>
                    <div class="button-add">
                        <?php if(checkPrivilege('add_bill.php')) { ?>
                        <button id="openModal">
                            <i class="fa-solid fa-plus icons"></i>
                            <span>add</span>
                        </button>
                        <?php } ?>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <div class="modal-content-close">
                                    <div class="text-add">
                                        <p> thêm Bill</p>
                                    </div>
                                    <button class="close">&times;</button>
                                </div>
                                <!-- Đây là nơi để bạn đặt form điền thông tin -->
                                <div class="modal-content-form">
                                    <form action="add_bill.php" method="post" id="myForm">
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="fullname">Họ và tên:</label><br>
                                                <input type="text" id="fullname" name="fullname" placeholder="Tên đầy đủ" >
                                                <div class="error-message" id="fullnameError">Vui lòng nhập họ và tên.</div>
                                            </div>
                                            <div class="flex-item2">
                                                <label for="phoneNumber">Số điện thoại:</label><br>
                                                <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" placeholder="Số điện thoại" ><br>
                                                <div class="error-message" id="phoneNumberError">Vui lòng nhập số điện thoại.</div>
                                            </div>
                                            <div class="flex-item3">
                                                <label for="dob">Ngày sinh:</label><br>
                                                <input type="date" id="dob" name="dob" ><br>
                                                <div class="error-message" id="dobError">Vui lòng nhập Ngày sinh.</div>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="RegistrationDate">Ngày đăng ký:</label><br>
                                                <input type="date" id="RegistrationDate" name="RegistrationDate">
                                                <div class="error-message" id="RegistrationDateError">Vui lòng nhập Ngày đăng ký.</div>
                                            </div>
                                            <div class="flex-item1">
                                                <label for="invoiceCode">Mã Hóa đơn:</label><br>
                                                <input type="text" id="invoiceCode" name="invoiceCode" placeholder="Mã hóa đơn">
                                                <div class="error-message" id="codeError">Vui lòng nhập Mã hóa đơn.</div>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="roadmap">Lộ trình:</label><br>
                                                <label><input type="checkbox" name="data[]" value="MG">MG</label>
                                                <label><input type="checkbox" name="data[]" value="GT">GT</label>
                                                <label><input type="checkbox" name="data[]" value="I3.0">I3.0</label>
                                                <label><input type="checkbox" name="data[]" value="I5.0">I5.0</label>
                                                <label><input type="checkbox" name="data[]" value="I6.5">I6.5</label>
                                                <label><input type="checkbox" name="data[]" value="Toeic S+W 200">Toeic S + W 200</label>
                                                <label><input type="checkbox" name="data[]" value="Toeic S+W 300">Toeic S + W 300</label>
                                                <label><input type="checkbox" name="data[]" value="Khóa luyện thi">Khóa luyện thi</label>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="totaltuition">Tổng học phí:</label><br>
                                                <input type="text" class="amount" id="totaltuition" name="totaltuition" placeholder="Tổng học phí" ><br>
                                            </div>
                                            <div class="flex-item2">
                                                <label for="paymoney">Số tiền đóng:</label><br>
                                                <input type="text" class="amount" id="paymoney" name="paymoney" placeholder="Số tiền đóng" ><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="baseregister">Cơ sở đăng ký:</label><br>
                                                <select id="baseregister" name="baseregister">
                                                    <option value="">Chọn cơ sở đăng ký</option>
                                                    <option value="Tạ Quang Bửu 1">Tạ Quang Bửu 1</option>
                                                    <option value="Trần Quốc Hoàn">Trần Quốc Hoàn</option>
                                                    <option value="Thanh Xuân">Thanh Xuân</option>
                                                    <option value="Trần Vỹ">Trần Vỹ</option>
                                                    <option value="Tạ Quang Bửu 2">Tạ Quang Bửu 2</option>
                                                    <!-- Thêm các tùy chọn khác nếu cần -->
                                                </select>
                                            </div>
                                            <div class="flex-item2">
                                                <label for="customersource">Nguồn khách hàng:</label><br>
                                                <select id="customersource" name="customersource">
                                                    <option value="">Chọn nguồn khách hàng</option>
                                                    <option value="Ấm nóng">Ấm nóng</option>
                                                    <option value="Nhân">Nhân</option>
                                                    <option value="Marketing">Marketing</option>
                                                    <option value="Truyền thông">Truyền thông</option>
                                                    <option value="Online xa">Online xa</option>
                                                    <option value="Nhân sự">Nhân sự</option>
                                                    <!-- Thêm các tùy chọn khác nếu cần -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="registrationform">Hình thức đăng ký:</label><br>
                                                <select id="registrationform" name="registrationform">
                                                    <option value="">Chọn hình thức đăng ký</option>
                                                    <option value="Tiền mặt">Tiền mặt</option>
                                                    <option value="Chuyển khoản">Chuyển khoản</option>
                                                    <option value="Quẹt thẻ">Quẹt thẻ</option>
                                                    <option value="Rút">Rút</option>
                                                    <!-- Thêm các tùy chọn khác nếu cần -->
                                                </select>
                                            </div>
                                            <div class="flex-item2">
                                                <label for="gistrationtimes">Lần đăng ký:</label><br>
                                                <select id="gistrationtimes" name="gistrationtimes">
                                                    <option value="">Lần đăng</option>
                                                    <option value="Lần đầu">Lần đầu</option>
                                                    <option value="Lần 2">Lần 2</option>
                                                    <option value="Lần 3">Lần 3</option>
                                                    <option value="Lần 4">Lần 4</option>
                                                    <option value="Lần 5">Lần 5</option>
                                                    <option value="Lần 6">Lần 6</option>
                                                    <!-- Thêm các tùy chọn khác nếu cần -->
                                                </select>
                                            </div>
                                            <div class="flex-item3">
                                                <label for="idPersonnal">Mã Key Sale:</label><br>
                                                <input type="text" id="idPersonnal" name="idPersonnal" placeholder="Mã key sale" ><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="email">Mail HV:</label><br>
                                                <input type="email" id="email" name="email" placeholder="Mail HV" ><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="Note">Note:</label><br>
                                                <textarea id="note" name="note"></textarea><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <input type="submit" value="Thêm">
                                            </div>    
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-setting" id="btn-setting">
                        <i class="fa-solid fa-gear icon"></i>
                    </div>
                </div>
                <div class="table" >
                    <table id="myTable">
                        <thead id="tableHead">
                            <tr>
                                <th data-column="1">ID</th>
                                <th data-column="2">Sale</th>
                                <th data-column="3">Ngày đăng ký</th>
                                <th data-column="4">Họ tên HV</th>
                                <th data-column="5">SĐT</th>
                                <th data-column="6">Ngày sinh</th>
                                <th data-column="7">Mã Hóa đơn</th>
                                <th data-column="8">Số tiền đóng</th>
                                <th data-column="9">Lộ trình</th>
                                <th data-column="10">Tổng học phí</th>
                                <th data-column="11">Cơ sở đăng ký</th>
                                <th data-column="12">Nguồn khách hàng</th>
                                <th data-column="13">Hình thức đăng ký</th>
                                <th data-column="14">Lần đăng ký</th>
                                <th data-column="15">Email HV</th>
                                <th data-column="16">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            //ketnoi
                            require_once 'conn_bill.php';
                            // Thiết lập số lượng bản ghi trên mỗi trang
                            $records_per_page = 100;

                            // Lấy trang hiện tại từ URL, mặc định là trang 1
                            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start_from = ($current_page - 1) * $records_per_page;

                            // Đếm tổng số bản ghi
                            $total_sql = "SELECT COUNT(*) FROM `bill`";
                            $total_result = mysqli_query($conn, $total_sql);
                            $total_rows = mysqli_fetch_row($total_result)[0];
                            $total_pages = ceil($total_rows / $records_per_page);
                            //caulenh
                            $interview_sql = "SELECT * FROM `bill` ORDER BY `bill`.`ID` DESC LIMIT $start_from, $records_per_page;";
                            //thuc thi cau lenh
                            $result=mysqli_query($conn, $interview_sql);

                            function formatCurrency($amount) {
                                return number_format($amount, 0, ',', '.');
                            }
                            
                            //duyet qua result và in ra
                            while($r = mysqli_fetch_assoc($result)){
                                $amount1 = $r["pay_money"];
                                $formattedAmount1 = formatCurrency($amount1);
                                $amount2 = $r["total_tuition"];
                                $formattedAmount2 = formatCurrency($amount2);
                                ?>
                                    <tr>
                                        <td data-column="1"><?php echo $r['ID'];?></td>
                                        <td data-column="2"><?php echo $r['ID_persontion'];?></td>
                                        <td data-column="3"><?php echo $r['Registration_Date'];?></td>
                                        <td data-column="4"><?php echo $r['Fullname'];?></td>
                                        <td data-column="5"><?php echo $r['phonenumber'];?></td>
                                        <td data-column="6"><?php echo $r['birthday'];?></td>
                                        <td data-column="7"><?php echo $r['invoiceCode'];?></td>
                                        <td data-column="8"><?php echo $formattedAmount1;?> VNĐ</td>
                                        <td data-column="9"><?php echo $r['roadmap'];?></td>
                                        <td data-column="10"><?php echo $formattedAmount2;?> VNĐ</td>
                                        <td data-column="11"><?php echo $r['base_register'];?></td>
                                        <td data-column="12"><?php echo $r['customer_source'];?></td>
                                        <td data-column="13"><?php echo $r['registration_form'];?></td>
                                        <td data-column="14"><?php echo $r['gistration_times'];?></td>
                                        <td data-column="15"><?php echo $r['Email'];?></td>
                                        <td data-column="16"><?php echo $r['note'];?></td>

                                        <td class="button">
                                            <!-- <?php if(checkPrivilege('information_bill.php?id=0')) { ?>
                                            <button>
                                                <i class="fa-solid fa-address-card icon" ></i>
                                            </button>
                                            <?php } ?> -->
                                            <?php if(checkPrivilege('edit_bill.php?id=0')) { ?>
                                            <button class="editButton" data-id="<?php echo $r['ID'];?>">
                                                <i class="fa-solid fa-pen-to-square icon"></i>
                                            </button>
                                            <?php } ?>
                                            <?php if(checkPrivilege('remove_bill.php?id=0')) { ?>
                                            <button>
                                                <a onclick="return confirm('bạn có muốn xóa nhân sự này không');" href="remove_bill.php?sid=<?php echo $r['ID']; ?>"><i class="fa-solid fa-user-minus icon"></i></a> 
                                            </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    <div id="Editmodal" class="modal">
                        <div class="modal-content">
                            <div class="modal-content-close">
                                <div class="text-edit">
                                    <p>Sửa thông tin Hóa đơn</p>
                                </div>
                                <button class="close">&times;</button>
                            </div>
                            <div class="modal-content-form">
                                <form action="update_bill.php" method="post" id="Edit">
                                    <div class="flex-container">
                                        <input type="hidden" id="billIdEdit" name="billIdEdit" value="">
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="fullname">Họ và tên:</label><br>
                                            <input type="text" id="fullnameEdit" name="fullnameEdit" placeholder="Tên đầy đủ" >
                                            <div class="error-message" id="fullnameEditError">Vui lòng nhập họ và tên.</div>
                                        </div>
                                        <div class="flex-item2">
                                            <label for="phoneNumber">Số điện thoại:</label><br>
                                            <input type="tel" id="phoneNumberEdit" name="phoneNumberEdit" pattern="[0-9]{10}" placeholder="Số điện thoại" ><br>
                                            <div class="error-message" id="phoneNumberEditError">Vui lòng nhập số điện thoại.</div>
                                        </div>
                                        <div class="flex-item3">
                                            <label for="dob">Ngày sinh:</label><br>
                                            <input type="date" id="dobEdit" name="dobEdit" ><br>
                                            <div class="error-message" id="dobEditError">Vui lòng nhập Ngày sinh.</div>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="RegistrationDate">Ngày đăng ký:</label><br>
                                            <input type="date" id="RegistrationDateEdit" name="RegistrationDateEdit">
                                            <div class="error-message" id="RegistrationDateEditError">Vui lòng nhập Ngày đăng ký.</div>
                                        </div>
                                        <div class="flex-item1">
                                            <label for="invoiceCode">Mã Hóa đơn:</label><br>
                                            <input type="text" id="invoiceCodeEdit" name="invoiceCodeEdit" placeholder="Mã hóa đơn">
                                            <div class="error-message" id="codeEditError">Vui lòng nhập Mã hóa đơn.</div>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="roadmap">Lộ trình:</label><br>
                                            <label><input type="checkbox" name="dataEdit[]" value="MG">MG</label>
                                            <label><input type="checkbox" name="dataEdit[]" value="GT">GT</label>
                                            <label><input type="checkbox" name="dataEdit[]" value="I3.0">I3.0</label>
                                            <label><input type="checkbox" name="dataEdit[]" value="I5.0">I5.0</label>
                                            <label><input type="checkbox" name="dataEdit[]" value="I6.5">I6.5</label>
                                            <label><input type="checkbox" name="dataEdit[]" value="Toeic S+W 200">Toeic S + W 200</label>
                                            <label><input type="checkbox" name="dataEdit[]" value="Toeic S+W 300">Toeic S + W 300</label>
                                            <label><input type="checkbox" name="dataEdit[]" value="Khóa luyện thi">Khóa luyện thi</label>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="totaltuition">Tổng học phí:</label><br>
                                            <input type="text" class="amount" id="totaltuitionEdit" name="totaltuitionEdit" placeholder="Tổng học phí" ><br>
                                        </div>
                                        <div class="flex-item2">
                                            <label for="paymoney">Số tiền đóng:</label><br>
                                            <input type="text" class="amount" id="paymoneyEdit" name="paymoneyEdit" placeholder="Số tiền đóng" ><br>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="baseregister">Cơ sở đăng ký:</label><br>
                                            <select id="baseregisterEdit" name="baseregisterEdit">
                                                <option value="">Chọn cơ sở đăng ký</option>
                                                <option value="Tạ Quang Bửu 1">Tạ Quang Bửu 1</option>
                                                <option value="Trần Quốc Hoàn">Trần Quốc Hoàn</option>
                                                <option value="Thanh Xuân">Thanh Xuân</option>
                                                <option value="Trần Vỹ">Trần Vỹ</option>
                                                <option value="Tạ Quang Bửu 2">Tạ Quang Bửu 2</option>
                                                <!-- Thêm các tùy chọn khác nếu cần -->
                                            </select>
                                        </div>
                                        <div class="flex-item2">
                                            <label for="customersource">Nguồn khách hàng:</label><br>
                                            <select id="customersourceEdit" name="customersourceEdit">
                                                <option value="">Chọn nguồn khách hàng</option>
                                                <option value="Ấm nóng">Ấm nóng</option>
                                                <option value="Nhân">Nhân</option>
                                                <option value="Marketing">Marketing</option>
                                                <option value="Truyền thông">Truyền thông</option>
                                                <option value="Online xa">Online xa</option>
                                                <option value="Nhân sự">Nhân sự</option>
                                                <!-- Thêm các tùy chọn khác nếu cần -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="registrationform">Hình thức đăng ký:</label><br>
                                            <select id="registrationformEdit" name="registrationformEdit">
                                                <option value="">Chọn hình thức đăng ký</option>
                                                <option value="Tiền mặt">Tiền mặt</option>
                                                <option value="Chuyển khoản">Chuyển khoản</option>
                                                <option value="Quẹt thẻ">Quẹt thẻ</option>
                                                <option value="Rút">Rút</option>
                                                <!-- Thêm các tùy chọn khác nếu cần -->
                                            </select>
                                        </div>
                                        <div class="flex-item2">
                                            <label for="gistrationtimes">Lần đăng ký:</label><br>
                                                <select id="gistrationtimesEdit" name="gistrationtimesEdit">
                                                    <option value="">Lần đăng</option>
                                                    <option value="Lần đầu">Lần đầu</option>
                                                    <option value="Lần 2">Lần 2</option>
                                                    <option value="Lần 3">Lần 3</option>
                                                    <option value="Lần 4">Lần 4</option>
                                                    <option value="Lần 5">Lần 5</option>
                                                    <option value="Lần 6">Lần 6</option>
                                                    <!-- Thêm các tùy chọn khác nếu cần -->
                                                </select>
                                        </div>
                                        <div class="flex-item3">
                                            <label for="idPersonnal">Mã Key Sale:</label><br>
                                            <input type="text" id="idPersonnalEdit" name="idPersonnalEdit" placeholder="Mã key sale" ><br>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="email">Mail HV:</label><br>
                                            <input type="email" id="emailEdit" name="emailEdit" placeholder="Mail HV" ><br>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="Note">Note:</label><br>
                                            <textarea id="noteEdit" name="noteEdit"></textarea><br>
                                        </div>
                                    </div>
                                    <div class="flex-container">
                                        <div class="flex-item1">
                                            <input type="submit" value="Sửa">
                                        </div>    
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($total_pages > 1) { ?>
                <div class="pagination">
                    <?php
                    // Hiển thị nút "Trang đầu"
                    if ($current_page > 1) {
                        echo "<a href='bill.php?page=1'>&laquo; First</a>";
                    }

                    // Hiển thị nút "Trang trước"
                    if ($current_page > 1) {
                        $prev_page = $current_page - 1;
                        echo "<a href='bill.php?page=$prev_page'>&lsaquo; Previous</a>";
                    }

                    // Hiển thị các trang lân cận
                    $range = 2; // Số lượng trang hiển thị xung quanh trang hiện tại
                    for ($i = max(1, $current_page - $range); $i <= min($total_pages, $current_page + $range); $i++) {
                        $active = ($i == $current_page) ? 'class="active"' : '';
                        echo "<a $active href='bill.php?page=$i'>$i</a>";
                    }

                    // Hiển thị nút "Trang kế tiếp"
                    if ($current_page < $total_pages) {
                        $next_page = $current_page + 1;
                        echo "<a href='bill.php?page=$next_page'>Next &rsaquo;</a>";
                    }

                    // Hiển thị nút "Trang cuối"
                    if ($current_page < $total_pages) {
                        echo "<a href='bill.php?page=$total_pages'>Last &raquo;</a>";
                    }
                    ?>
                </div>
                <?php } ?>
            </div>
            <div class="form-setting" id="form-setting">
                <form action="" id="columnForm">
                    <label><input type="checkbox" class="toggleColumn" data-column="1" checked>ID</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="2"checked>Sale</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="3"checked>Thời gian đăng ký</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="4"checked>Họ tên HV</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="5"checked>SĐT</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="6"checked>Ngày sinh</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="7"checked>Mã hóa đơn</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="8">Số tiền đóng</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="9">Lộ trình</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="10">Tổng học phí</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="11">Cơ sở đăng ký</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="12">Nguồn khách hàng</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="13">Hình thức đăng ký</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="14">Lần đăng ký</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="15">Email HV</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="16">Note</label><br>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        var searchButton = document.getElementById("searchButton");
        var searchContainer = document.getElementById("searchContainer");
        searchContainer.style.width = (searchButton.offsetWidth + 10) + "px"; // Thêm 10px padding
    };

    function toggleSearch() {
        var searchContainer = document.getElementById("searchContainer");
        var searchInput = document.getElementById("searchInput");
        var searchButton = document.getElementById("searchButton");

        if (searchInput.style.display === "none") {
            searchInput.style.display = "inline-block";
            searchContainer.style.width = (searchInput.offsetWidth + 54) + "px"; // Thêm 10px padding
        } else {
            searchInput.style.display = "none";
            searchContainer.style.width = (searchButton.offsetWidth + 10) + "px"; // Thêm 10px padding
        }
    }
    window.onload = function() {
    var loginBoxHeight = document.querySelector('.login-box').offsetHeight;
    document.querySelector('.display').style.height = loginBoxHeight + 'px';
    };
    // Lấy đối tượng modal
    var modal = document.getElementById("myModal");

    // Lấy nút mở modal
    var btn = document.getElementById("openModal");

    // Lấy nút đóng modal
    var span = document.getElementsByClassName("close")[0];

    // Khi người dùng nhấn vào nút, mở modal
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // Khi người dùng nhấn vào nút đóng, đóng modal và reset form
    span.onclick = function() {
    modal.style.display = "none";
    modalEdit.style.display = "none";
    resetForm();
    }

    // Khi người dùng nhấn ESC, đóng modal và reset form
    window.onkeydown = function(event) {
    if (event.key === "Escape") {
    modal.style.display = "none";
    modalEdit.style.display = "none";
    resetForm();
    }
    }

    // Xử lý sự kiện gửi form
    document.getElementById("myForm").onsubmit = function(event) {
    // Kiểm tra các trường nhập liệu
    if (!validateForm()) {
    event.preventDefault(); // Ngăn chặn gửi form nếu có lỗi
    }
    };

    // Hàm kiểm tra form
    function validateForm() {
    var isValid = true;

    // Kiểm tra họ và tên
    var fullname = document.getElementById("fullname");
    var fullnameError = document.getElementById("fullnameError");
    if (fullname.value.trim() === "") {
    fullnameError.style.display = "block";
    isValid = false;
    } else {
    fullnameError.style.display = "none";
    }

    // Kiểm tra mã cấp trên
    var code = document.getElementById("code");
    var codeError = document.getElementById("codeError");
    if (code.value.trim() === "") {
    codeError.style.display = "block";
    isValid = false;
    } else {
    codeError.style.display = "none";
    }

    // Kiểm tra văn phòng
    var office = document.getElementById("office");
    var officeError = document.getElementById("officeError");
    if (office.value.trim() === "") {
    officeError.style.display = "block";
    isValid = false;
    } else {
    officeError.style.display = "none";
    }

    // Kiểm tra thời gian bắt đầu làm việc
    var startDate = document.getElementById("startDate");
    var startDateError = document.getElementById("startDateError");
    if (startDate.value.trim() === "") {
    startDateError.style.display = "block";
    isValid = false;
    } else {
    startDateError.style.display = "none";
    }

    //kiểm tra quê quán
    var hometown = document.getElementById("hometown");
    var hometownError = document.getElementById("hometownError");
    if (hometown.value.trim() === "") {
        hometownError.style.display = "block";
        isValid = false;
    } else {
        hometownError.style.display = "none";
    }

    // Kiểm tra vị trí hiện tại
    var position = document.getElementById("position");
    var positionError = document.getElementById("positionError");
    if (position.value.trim() === "") {
    positionError.style.display = "block";
    isValid = false;
    } else {
    positionError.style.display = "none";
    }
    var position = document.getElementById("position");
    var positionError = document.getElementById("positionError");
    if (position.value.trim() === "") {
    positionError.style.display = "block";
    isValid = false;
    } else {
    positionError.style.display = "none";
    }

    // Kiểm tra số điện thoại
    var phoneNumber = document.getElementById("phoneNumber");
    var phoneNumberError = document.getElementById("phoneNumberError");
    if (phoneNumber.value.trim() === "" || !phoneNumber.checkValidity()) {
    phoneNumberError.style.display = "block";
    isValid = false;
    } else {
    phoneNumberError.style.display = "none";
    }

    // Kiểm tra ngày sinh
    var dob = document.getElementById("dob");
    var dobError = document.getElementById("dobError");
    if (dob.value.trim() === "") {
    dobError.style.display = "block";
    isValid = false;
    } else {
    dobError.style.display = "none";
    }

    // Kiểm tra giới tính
    var gender = document.getElementById("gender");
    var genderError = document.getElementById("genderError");
    if (gender.value.trim() === "") {
    genderError.style.display = "block";
    isValid = false;
    } else {
    genderError.style.display = "none";
    }

    // Kiểm tra email
    var email = document.getElementById("email");
    var emailError = document.getElementById("emailError");
    if (email.value.trim() === "" || !email.checkValidity()) {
    emailError.style.display = "block";
    isValid = false;
    } else {
    emailError.style.display = "none";
    }

    return isValid;
    }

    // Hàm đặt lại form
    function resetForm() {
    var form = document.getElementById("myForm");
    form.reset();

    // Ẩn tất cả thông báo lỗi
    var errorMessages = document.getElementsByClassName("error-message");
    for (var i = 0; i < errorMessages.length; i++) {
    errorMessages[i].style.display = "none";
    }
    }
    var modalEdit = document.getElementById("Editmodal");
    // var btnEdit = document.getElementById("openEdit");
    var spanEdit = document.getElementsByClassName("close")[1];
    // btnEdit.onclick = function() {
    //     modalEdit.style.display = "block";
    // }
    spanEdit.onclick = function() {
        modalEdit.style.display = "none";
    }
    // Lắng nghe sự kiện click trên tất cả các nút chỉnh sửa
    var editButtons = document.querySelectorAll('.editButton');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Lấy giá trị ID của nhân viên từ thuộc tính data-id
            var interviewId = this.getAttribute('data-id');

            // Gửi yêu cầu AJAX đến tập tin PHP xử lý
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'edit_bill.php?id=' + interviewId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Parse dữ liệu nhận được từ response
                    var data = JSON.parse(xhr.responseText);
                    
                    // Hiển thị thông tin của nhân viên trong form chỉnh sửa
                    document.getElementById('billIdEdit').value = data.ID;
                    document.getElementById('fullnameEdit').value = data.Fullname;
                    document.getElementById('phoneNumberEdit').value = data.phonenumber;
                    document.getElementById('dobEdit').value = data.birthday;
                    document.getElementById('RegistrationDateEdit').value = data.Registration_Date;
                    document.getElementById('invoiceCodeEdit').value = data.invoiceCode;
                    document.getElementById('totaltuitionEdit').value = data.total_tuition;
                    document.getElementById('paymoneyEdit').value = data.pay_money;
                    document.getElementById('baseregisterEdit').value = data.base_register;
                    document.getElementById('customersourceEdit').value = data.customer_source;
                    document.getElementById('registrationformEdit').value = data.registration_form;
                    document.getElementById('gistrationtimesEdit').value = data.gistration_times;
                    document.getElementById('idPersonnalEdit').value = data.ID_persontion;
                    document.getElementById('emailEdit').value = data.Email;
                    document.getElementById('noteEdit').value = data.note;

                    // Hiển thị modal chỉnh sửa
                    document.getElementById('Editmodal').style.display = 'block';
                } else {
                    // Hiển thị thông báo lỗi
                    alert('Có lỗi xảy ra khi tải thông tin phỏng vấn.');
                }
            };
            xhr.send();
        });
    });
    var columnForm = document.getElementById('columnForm');
    var tableHead = document.getElementById('tableHead');
    
    var toggleColumns = function () {
      var checkboxes = columnForm.querySelectorAll('.toggleColumn');
      
      checkboxes.forEach(function(checkbox) {
        var column = parseInt(checkbox.getAttribute('data-column'));
        var header = tableHead.querySelector('th[data-column="' + column + '"]');
        var cells = document.querySelectorAll('td[data-column="' + column + '"]');
        
        if (checkbox.checked) {
          header.style.display = 'table-cell';
          cells.forEach(function(cell) {
            cell.style.display = 'table-cell';
          });
        } else {
          header.style.display = 'none';
          cells.forEach(function(cell) {
            cell.style.display = 'none';
          });
        }
      });
    };
    
    columnForm.addEventListener('change', toggleColumns);
    toggleColumns(); // Hiển thị các cột ban đầu
    var btn= document.getElementById('btn-setting')
    var setting= document.getElementById('form-setting')
    var formVisible = false;
    function btnform() {
        if(!formVisible)
        {
            setting.style.display='block';
        } else {
            setting.style.display='none';
        }
        formVisible = !formVisible;
    }
    btn.addEventListener('click', btnform);
    function formatCurrency(input) {
    // Lấy giá trị hiện tại của input
        let value = input.value;
        
        // Loại bỏ tất cả ký tự không phải số
        value = value.replace(/[^0-9]/g, '');
        
        // Chuyển số thành dạng có dấu phân cách hàng nghìn
        let formattedValue = new Intl.NumberFormat('vi-VN').format(value);
        
        // Cập nhật giá trị của input
        input.value = formattedValue;
    }

    // Lấy tất cả các input có class 'amount'
    const amountInputs = document.querySelectorAll('.amount');

    // Thêm sự kiện 'input' cho từng input
    amountInputs.forEach(input => {
        input.addEventListener('input', () => formatCurrency(input));
    });
    var confirmed = false; // Tạo một biến để theo dõi xem người dùng đã xác nhận hay chưa

    function confirmLogout() {
        if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
            confirmed = true; // Đặt biến confirmed thành true nếu người dùng đồng ý
            window.location.href = "/Web_quan_ly_nhan_su/logout.php"; // Chuyển hướng đến trang logout.php nếu người dùng đồng ý đăng xuất
        }
    }
</script>
</body>
</html>
