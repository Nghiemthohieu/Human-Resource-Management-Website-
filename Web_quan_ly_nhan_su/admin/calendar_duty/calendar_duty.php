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
        }

        /* Style cho thẻ div mới */
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
            background-color: #F7F1FF; /* Thêm màu nền cho div avatar-menu */
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
        ::-webkit-scrollbar{
            width: 5px;
        }
        ::-webkit-scrollbar-thumb{
            background-color: grey;
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
            font-family: 'Arial Bold';
            padding-left: 30px;
            color: #5D5959;
        }
        .menu-box button:hover{
            color: #000;
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
          display: flex; /* Sử dụng flexbox */
          align-items: center; /* Canh giữa theo chiều dọc */
          justify-content: flex-start; /* Đặt phần tử ở bên trái */
          position: relative;
          flex: 2;
          background-color: #ffffff;
          padding: 0px 20px;
          border-top-right-radius: 15px;
          
        }

        .display-header h2 {
            margin: 0; /* Reset margin để không cần thiết */
        }

        .display-body {
            flex: 8;
            background-color: #ffffff;
            padding: 10px;
            border-bottom-right-radius: 15px;

        }
        .button{
            display: flex;
        }
        .date-box {
            border: 1px solid #000000;
            padding: 5px 10px;
            border-radius: 12px;
            width: 90px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            background-color: #D9D9D9;
            box-shadow: 2px 2px 10px rgba(25, 25, 25, 0.2);
            margin-left: 50px;
        }
        .button i.icon{
            font-size: 20px;
            align-items: center; /* Canh giữa theo chiều dọc */
            padding: 5px;
            color: rgb(96, 62, 62);
        }
        table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
            font-weight: bold;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: center;
            font-family: Arial;
            border: 2px solid #ffffff;
            background-color: #df9f9f;
        }
        th{
            color: #000000;
            font-size: 12px;
        }
        td{
            font-size: 11px;
        }
        .work-shift{
            font-size: 12px;
        }
        .button-add {
            flex: 1;
            display: flex;
            justify-content: flex-end; /* Căn phần tử con sang bên phải của màn hình */
            align-items: center; /* Căn phần tử con theo chiều dọc */
            padding-right: 20px; /* Tăng khoảng cách phía bên phải */
        }
        .button-add button {
            margin-left: 10px; /* Tạo khoảng cách giữa các nút */
            padding: 5px 8px;
            border-radius: 15px ;
            font-weight: bold;
            background-color: #F85039;
            box-shadow: 2px 2px 10px rgba(25, 25, 25, 0.2);
            margin-right: 10px ;
        }
        .button-add button:hover{
            background-color: #f84f39b0;
        }
        .button-add button i.icons{
            border: 2px solid #000000;
            border-radius: 15px;
            padding: 2px 3px;
        }
        .turn-dow button
        {
            border: 3px solid #dc7070;
            background-color: #fff;
            padding: 5px 7.5px;
            margin-left: 0px;
            margin-right: 0px;
        }
        .turn-dow button i.turn-dow{
            color: #dc7070;
            font-weight: bold;
        }
        .turn-dow button:hover{
            background-color: #ffffffa9;
            border: 3px solid #dc7070a3;
            color:#dc7070a3
        }
        .current-date {
            background-color: #a18779; /* Màu nền cho ngày hiện tại */
            color: #eaff00; /* Màu chữ cho ngày hiện tại */
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
            top: 20%;
            left: 35%;
            transform: translate(-50%, -50%);
            border: 1px solid #888;
            width: 30%;
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
        .btn-infor{
            background-color: #f0f8ff00;
            border: 0px;
        }
    </style>
</head>
<body>
<div class="overlay"></div> <!-- Thêm thẻ div overlay -->
<div class="login-box">
    <div class="avatar-menu">
        <div class="avatar">
            <div class="avarta-img">
                <button class="btn-infor" onclick="window.location.href='/Web_quan_ly_nhan_su/admin/information/information.php'">
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
          <h2>Lịch trực</h2>
        </div>
        <div class="display-body">
            <div class="button">
                <div class="date-box" id="dateBox"></div>
                <i class="fa-solid fa-calendar-days icon"></i>
                <div class="button-add">
                    <?php if(checkPrivilege('add_calendarduty.php')) { ?>
                    <button id="openModal">
                        <i class="fa-solid fa-plus icons"></i>
                        <span>Đăng ký lịch Trực</span>
                    </button>
                    <?php } ?>
                    <div id="myModal" class="modal">
                            <div class="modal-content">
                                <div class="modal-content-close">
                                    <div class="text-add">
                                        <p> Đăng ký lịch làm việc</p>
                                    </div>
                                    <button class="close">&times;</button>
                                </div>
                                <!-- Đây là nơi để bạn đặt form điền thông tin -->
                                <div class="modal-content-form">
                                    <form action="add_calendarduty.php" method="post" id="myForm">
                                        <div class="flex-container">
                                            <input type="hidden" id="personnalId" name="personnalId" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                            <select id="date" name="date">
                                                <?php
                                                    // Tính toán các ngày trong tuần hiện tại
                                                    $startOfWeek = new DateTime();
                                                    $startOfWeek->setISODate((int)$startOfWeek->format('o'), (int)$startOfWeek->format('W'), 1); // Set to Monday of current week

                                                    $dates = [];
                                                    for ($i = 0; $i < 6; $i++) {
                                                        $dates[] = $startOfWeek->format('Y-m-d');
                                                        $startOfWeek->modify('+1 day');
                                                    }
                                                ?>
                                                <option value="">Thứ</option>
                                                <option value="<?php echo $dates[0]?>">Thứ 2</option>
                                                <option value="<?php echo $dates[1]?>">Thứ 3</option>
                                                <option value="<?php echo $dates[2]?>">Thứ 4</option>
                                                <option value="<?php echo $dates[3]?>">Thứ 5</option>
                                                <option value="<?php echo $dates[4]?>">Thứ 6</option>
                                                <option value="<?php echo $dates[5]?>">Thứ 7</option>
                                                <!-- Thêm các tùy chọn khác nếu cần -->                                               
                                            </select>
                                            </div>    
                                            <div class="flex-item2">
                                            <select id="shift" name="shift">
                                                <option value="">Ca trực</option>
                                                <option value="Ca sáng">Ca sáng</option>
                                                <option value="Ca chiều">Ca chiều</option>
                                                <!-- Thêm các tùy chọn khác nếu cần -->
                                            </select>
                                            </div>  
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <input type="submit" value="Đăng ký">
                                            </div>    
                                        </div>
                                    </form>
                                </div>
                    </div>
                    </div>
                    <div class="turn-dow">
                        <button id='btnPrevWeek'>
                            <i class="fa-solid fa-arrow-left turn-dow"></i>
                        </button>
                        <button id='btnNextWeek'>
                            <i class="fa-solid fa-arrow-right turn-dow"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="calendar">
                <form action="">
                    <table>
                        <thead>
                            <tr>
                                <th>Ca làm việc</th>
                                <th>
                                    <p>Thứ 2</p>
                                    <p class="work-date"></p>
                                </th>
                                <th>
                                    <p>Thứ 3</p>
                                    <p class="work-date"></p>
                                </th>
                                <th>
                                    <p>Thứ 4</p>
                                    <p class="work-date"></p>
                                </th>
                                <th>
                                    <p>Thứ 5</p>
                                    <p class="work-date"></p>
                                </th>
                                <th>
                                    <p>Thứ 6</p>
                                    <p class="work-date"></p>
                                </th>
                                <th>
                                    <p>Thứ 7</p>
                                    <p class="work-date"></p>
                                </th>
                                <th>
                                    <p>Chủ nhật</p>
                                    <p class="work-date"></p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'conn_calendardyty.php';

                            date_default_timezone_set('Asia/Ho_Chi_Minh');

                            $weekOffset = 0;

                            $sql = "SELECT dutyschedule.*, personnal.Name AS personnal_name FROM dutyschedule JOIN personnal ON dutyschedule.ID_personnal = personnal.ID_personnal ORDER BY date, shift";
                            $result = $conn->query($sql);

                            $duty_schedule = array();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // echo "Date: " . $row["date"] . ", Shift: " . $row["shift"] . ", Name: " . $row["personnal_name"] . "<br>"; // Xuất gỡ lỗi
                                    $duty_schedule[$row["date"]][$row["shift"]][] = $row["personnal_name"];
                                }

                                $shifts = array("Ca sáng", "Ca chiều");
                                foreach ($shifts as $shift) {
                                    echo "<tr>";
                                    echo "<td class='work-shift'>$shift</td>";

                                    for ($i = 0; $i < 7; $i++) {
                                        $current_date = date('Y-m-d', strtotime('monday this week +' . $i . ' days +' . ($weekOffset * 7) . ' days'));

                                        echo "<td>";
                                        if (isset($duty_schedule[$current_date]) && isset($duty_schedule[$current_date][$shift])) {
                                            foreach ($duty_schedule[$current_date][$shift] as $name) {
                                                echo "<p>" . $name . "</p>";
                                            }
                                        } 
                                        echo "</td>";
                                    }
                                    echo "</tr>";
                                }
                            } 

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var currentWeek = 0; // Biến toàn cục để lưu số tuần hiện tại

    function formatVietnameseDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1 ;
        var year = date.getFullYear();
        return day + '/' + month + '/' + year;
    }
    function formatVietnameseDate1(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '/' + month + '/' + year;
    }

    function updateDate(weekDiff) {
        currentWeek += weekDiff; // Cập nhật giá trị của biến currentWeek

        var currentDate = new Date();
        currentDate.setDate(currentDate.getDate()  + currentWeek * 7);

        var nextDay = new Date(currentDate); // Tạo một bản sao của currentDate

        var ps = document.querySelectorAll('.work-date');
        ps.forEach(function (p, index) {
           // Sử dụng nextDay để cập nhật giá trị cho mỗi phần tử .work-date
            nextDay.setDate(currentDate.getDate() + index - currentDate.getDay() + 1);
            p.textContent = formatVietnameseDate(nextDay);
        });
    }

    var currentWeeks = 0;

    // Hàm để cập nhật ngày
    function updateDate1() {
        var dateBox = document.getElementById("dateBox");
        var currentDate = new Date();
        var formattedDate = formatVietnameseDate1(currentDate);
        dateBox.textContent = formattedDate;

        // Lấy ngày trong tuần (0: Chủ nhật, 1: Thứ hai, ..., 6: Thứ bảy)
        var currentDayOfWeek = (currentDate.getDay() );

        // Lấy tất cả các phần tử th trong bảng
        var thElements = document.querySelectorAll('th');

        // Lặp qua các phần tử th
        thElements.forEach(function (th, index) {
            // Nếu là phần tử th của ngày hiện tại
            if (currentWeeks === 0) {
                if (index === currentDayOfWeek) {
                    th.classList.add('current-date'); // Thêm lớp CSS để tô màu
                } else {
                    th.classList.remove('current-date'); // Xóa lớp CSS nếu không phải ngày hiện tại
                }
            } else {
                th.classList.remove('current-date'); // Xóa lớp CSS nếu không phải ngày hiện tại
            }
        });
    }

    // Cập nhật ngày khi trang được tải
    updateDate(0);
    updateDate1();
    
    // Hàm để gửi dữ liệu sang script PHP bằng AJAX
    function updateTableBody() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "get_calendarduty.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var tbody = document.querySelector('tbody');
                tbody.innerHTML = xhr.responseText;
            }
        };
        xhr.send('weekOffset=' + currentWeeks);
        console.log(currentWeeks);
    }
    // Sự kiện khi ấn nút lùi lại 1 tuần
    document.getElementById('btnPrevWeek').addEventListener('click', function () {
        currentWeeks--;
        updateDate(-1);
        updateDate1();
        updateTableBody();
    });

    // Sự kiện khi ấn nút tiến tới 1 tuần
    document.getElementById('btnNextWeek').addEventListener('click', function () {
        currentWeeks++;
        updateDate(1);
        updateDate1();
        updateTableBody();
    });

    // Lấy tất cả các phần tử có class là "work-date"
    var workDateElements = document.querySelectorAll('.work-date');

    // Lặp qua từng phần tử và gửi dữ liệu sang script PHP
    workDateElements.forEach(function (element) {
        var workDate = element.textContent;
    });

    var confirmed = false; // Tạo một biến để theo dõi xem người dùng đã xác nhận hay chưa

    function confirmLogout() {
        if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
            confirmed = true; // Đặt biến confirmed thành true nếu người dùng đồng ý
            window.location.href = "/Web_quan_ly_nhan_su/logout.php"; // Chuyển hướng đến trang logout.php nếu người dùng đồng ý đăng xuất
        }
    }
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
    resetForm();
    }

    // Khi người dùng nhấn ESC, đóng modal và reset form
    window.onkeydown = function(event) {
    if (event.key === "Escape") {
    modal.style.display = "none";
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
    function resetForm() {
    var form = document.getElementById("myForm");
    form.reset();

    // Ẩn tất cả thông báo lỗi
    var errorMessages = document.getElementsByClassName("error-message");
    for (var i = 0; i < errorMessages.length; i++) {
    errorMessages[i].style.display = "none";
    }
    }
</script>
</body>
</html>
