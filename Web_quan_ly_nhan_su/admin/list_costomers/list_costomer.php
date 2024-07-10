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
            width: 180px;
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
            color: #000000;
            border: 1px solid #000000;
            box-shadow: 0px 0px 10px rgb(126 83 83 / 55%);
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
            height: 100%;
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
            top: 1%;
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
        .btn{
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
        .cmb-personnal{
            padding-left: 30px;
        }
        .input_personnal{
            padding: 4px 6px;
            border-radius: 5px;
            background-color: #F85039;
            box-shadow: 0px 0px 10px rgb(126 83 83 / 55%);
        }
        .input_personnal:hover{
            background-color: #f8503994;
            color: #000000ab;
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
          <h2>Danh sách khách hàng</h2>
        </div>
        <div class="display-body">
            <div class="display-body-home">
                <div class="btn">
                    <div class="cmb-personnal">
                    <form method="post">
                            <select id="idPersonnal" name="idPersonnal" onchange="fetchEmployeeInfo()">
                                <?php
                                    //ketnoi
                                    include "../includes/conn.php";

                                    function getAllSubTeams($conn, $parent_team_id) {
                                        $sub_teams = [];
                                        $sql = "WITH RECURSIVE team_hierarchy AS (
                                                    -- Bắt đầu từ nhóm gốc dựa trên ID được cung cấp
                                                    SELECT
                                                        t.ID,
                                                        t.ID_teams,
                                                        t.ID_personnal
                                                    FROM
                                                        teams t
                                                    WHERE
                                                        t.ID_teams = $parent_team_id
                                                    
                                                    UNION ALL
                                                    
                                                    -- Đệ quy để lấy tất cả các nhóm con
                                                    SELECT
                                                        t.ID,
                                                        t.ID_teams,
                                                        t.ID_personnal
                                                    FROM
                                                        teams t
                                                    INNER JOIN team_hierarchy th ON t.ID_teams = th.ID_personnal
                                                )
                                                SELECT
                                                    p.ID_personnal
                                                FROM
                                                    team_hierarchy th
                                                JOIN
                                                    personnal p ON th.ID_personnal = p.ID_personnal
                                                WHERE
                                                    p.ID_status = 1;";
                                        $result = $conn->query($sql);
            
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $sub_teams[] = $row["ID_personnal"];
                                                $sub_teams = array_merge($sub_teams, getAllSubTeams($conn, $row["ID_personnal"]));
                                            }
                                        }
            
                                        return $sub_teams;
                                    }
                                    // ID của team chính
                                    $main_team_id = htmlspecialchars($_SESSION['user_id']);

                                    // Lấy tất cả các team con của team chính
                                    $team_ids = getAllSubTeams($conn, $main_team_id);
                                    $team_ids[] = $main_team_id; // Bao gồm cả team chính

                                    // Chuyển mảng team_ids thành chuỗi để sử dụng trong câu lệnh SQL
                                    $team_ids_str = implode(',', $team_ids);
                                    //caulenh
                                    $lietke_sql = "SELECT * FROM `personnal` ";
                                    //thuc thi cau lenh
                                    $result=mysqli_query($conn, $lietke_sql);
                                    //duyet qua result và in ra
                                    while($r = mysqli_fetch_assoc($result)) {
                                        if (in_array($r["ID_personnal"], $team_ids))
                                        {
                                            ?>
                                                <option value="<?php echo $r['ID_personnal'];?>" <?php if(isset($_POST['idPersonnal']) && $_POST['idPersonnal'] == $r['ID_personnal']) echo 'selected'; ?>><?php echo $r['Name'];?></option>
                                            <?php
                                        }
                                    }
                                ?>
                                <!-- Thêm các tùy chọn khác nếu cần -->
                            </select>
                            <input class="input_personnal" type="submit" name="submit" value="Chọn">
                        </form>
                    </div>
                    <div class="search">
                        <div class="search-container" id="searchContainer">
                            <button id="searchButton" onclick="toggleSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <input type="text" id="searchInput" placeholder="Nhập từ khóa">
                        </div>
                        <div class="button-add">
                            <?php if(checkPrivilege('add_listcostomers.php')) { ?>
                                <button id="openModal">
                                    <i class="fa-solid fa-plus icons"></i>
                                    <span>add</span>
                                </button>
                            <?php } ?>
                            <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <div class="modal-content-close">
                                        <div class="text-add">
                                            <p>Thêm Khách hàng</p>
                                        </div>
                                        <button class="close">&times;</button>
                                    </div>
                                    <!-- Đây là nơi để bạn đặt form điền thông tin -->
                                    <div class="modal-content-form">
                                        <form action="add_listcostomers.php" method="post" id="myForm">
                                            <div class="flex-container">
                                                <input type="hidden" id="personnal_ID" name="personnal_ID" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                                            </div>
                                            <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="fullname">Họ và tên:</label><br>
                                                <input type="text" id="fullname" name="fullname" placeholder="Tên đầy đủ" >
                                                <div class="error-message" id="fullnameError">Vui lòng nhập họ và tên.</div>
                                            </div>
                                            <div class="flex-item2">
                                                <label for="Relationship">Mối quan hệ:</label><br>
                                                <input type="text" id="Relationship	" name="Relationship" placeholder="Mối quan hệ" >
                                                <div class="error-message" id="RelationshipError">Vui lòng nhập mối quan hệ.</div>
                                            </div>
                                            </div>
                                            <div class="flex-container">
                                                <div class="flex-item1">
                                                    <label for="Yearbirth">Năm sinh:</label><br>
                                                    <input type="text" id="Yearbirth" name="Yearbirth" placeholder="năm sinh">
                                                    <div class="error-message" id="YearbirthError">Vui lòng nhập năm sinh.</div>
                                                </div>
                                                <div class="flex-item2">
                                                    <label for="school">Trường: </label><br>
                                                    <input type="text" id="school" name="school" placeholder="Trường học" ><br>
                                                    <div class="error-message" id="schoolError">Vui lòng nhập Trường học</div>
                                                </div>
                                                <div class="flex-item3">
                                                    <label for="majors">Ngành học: </label><br>
                                                    <input type="text" id="majors" name="majors" placeholder="Ngành học" ><br>
                                                </div>
                                            </div>
                                            <div class="flex-container">
                                                <div class="flex-item1">
                                                    <label for="Address">Địa chỉ hiện tại:</label><br>
                                                    <input type="text" id="Address" name="Address" placeholder="Địa chỉ hiện tại" ><br>
                                                </div>
                                            </div>
                                            <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="phoneNumber">Số điện thoại:</label><br>
                                                <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" placeholder="Số điện thoại" ><br>
                                            </div>
                                            <div class="flex-item2">
                                                <label for="freetime">Thời gian rảnh: </label><br>
                                                <input type="text" id="freetime" name="freetime" placeholder="Thời gian rảnh"><br>
                                                <div class="error-message" id="freetimeError">Vui lòng nhập ngày sinh.</div>
                                            </div>
                                            </div> 
                                            <div class="flex-container">
                                                <div class="flex-item1">
                                                    <label for="Problem">Vấn đề:</label><br>
                                                    <input type="text" id="Problem" name="Problem" placeholder="Vấn đề"><br>
                                                </div>
                                            </div>
                                            <div class="flex-container">
                                                <div class="flex-item1">
                                                    <label for="level">Trình độ tiếng anh:</label><br>
                                                    <input type="text" id="level" name="level" placeholder="Trình độ" ><br>
                                                </div> 
                                                <div class="flex-item2">
                                                    <label for="demand">Nhu cầu:</label><br>
                                                    <input type="text" id="demand" name="demand" placeholder="Nhu cầu" ><br>
                                                </div> 
                                                <div class="flex-item3">
                                                    <label for="target">Mục đích học:</label><br>
                                                    <input type="text" id="target" name="target" placeholder="Mục đích học" ><br>
                                                </div> 
                                            </div>
                                            <div class="flex-container">
                                                <div class="flex-item1">
                                                    <label for="understanding">Độ hiểu biết</label><br>
                                                    <input type="text" id="understanding" name="understanding" placeholder="Độ hiểu biết" ><br>
                                                </div> 
                                                <div class="flex-item2">
                                                    <label for="concerned">Quan tâm gì về sản phẩm:</label><br>
                                                    <input type="text" id="concerned" name="concerned" placeholder="Quan tâm" ><br>
                                                </div>  
                                                <div class="flex-item3">
                                                    <label for="studytime">Thời điểm muốn học:</label><br>
                                                    <input type="text" id="studytime" name="studytime" placeholder="Thời điểm muốn học" ><br>
                                                </div>  
                                            </div>
                                            <div class="flex-container">
                                                <div class="flex-item1">
                                                    <label for="circumstances">Hoàn cảnh:</label><br>
                                                    <input type="text" id="circumstances" name="circumstances" placeholder="Hoàn cảnh" ><br>
                                                </div> 
                                                <div class="flex-item2">
                                                    <label for="opinion">Ý kiến gia đình:</label><br>
                                                    <input type="text" id="opinion" name="opinion" placeholder="ý kiến gia đình" ><br>
                                                </div> 
                                                <div class="flex-item3">
                                                    <label for="tuition">GD - Học phí:</label><br>
                                                    <input type="text" id="tuition" name="tuition" placeholder="GD - Học phí" ><br>
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
                </div>
                <div class="table" >
                    <table id="myTable">
                        <thead id="tableHead">
                            <tr>
                                <th data-column="1">ID</th>
                                <th data-column="20">Sale</th>
                                <th data-column="2">Họ tên</th>
                                <th data-column="21">SĐT</th>
                                <th data-column="3">Mối quan hệ</th>
                                <th data-column="4">Năm sinh</th>
                                <th data-column="5">Trường</th>
                                <th data-column="6">Ngành</th>
                                <th data-column="7">Địa chỉ hiện tại</th>
                                <th data-column="8">Thời gian rảnh</th>
                                <th data-column="9">Vấn đề</th>
                                <th data-column="10">Trình độ</th>
                                <th data-column="11">Nhu cầu</th>
                                <th data-column="12">Mục đích</th>
                                <th data-column="13">Thời điểm học</th>
                                <th data-column="14">Độ hiểu biết</th>
                                <th data-column="15">Quan tâm gì về sản phẩm</th>
                                <th data-column="16">Hoàn cảnh</th>
                                <th data-column="17">ý kiến gia đình</th>
                                <th data-column="18">GĐ_học phí</th>
                                <th data-column="19">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //ketnoi
                                require_once 'conn_liscostomers.php';
                                    $idPersonnal= htmlspecialchars($_SESSION['user_id']);
                                    $selected_id_personnal = isset($_POST['idPersonnal']) ? $_POST['idPersonnal'] : $idPersonnal;
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
                        </tbody>
                    </table>
                    <div id="Editmodal" class="modal">
                        <div class="modal-content">
                            <div class="modal-content-close">
                                <div class="text-edit">
                                    <p>Sửa thông tin Khách hàng</p>
                                </div>
                                <button class="close">&times;</button>
                            </div>
                            <div class="modal-content-form">
                            <form action="update_customers.php" method="post" id="Edit">
                                <div class="flex-container">
                                        <input type="hidden" id="listcostomersIdEdit" name="listcostomersIdEdit" value="">
                                </div>
                                <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="fullnameEdit">Họ và tên:</label><br>
                                            <input type="text" id="fullnameEdit" name="fullnameEdit" placeholder="Tên đầy đủ" >
                                            <div class="error-message" id="fullnameEditError">Vui lòng nhập họ và tên.</div>
                                        </div>
                                        <div class="flex-item2">
                                            <label for="Relationship">Mối quan hệ:</label><br>
                                            <input type="text" id="RelationshipEdit" name="RelationshipEdit" placeholder="Mối quan hệ" >
                                            <div class="error-message" id="RelationshipEditError">Vui lòng nhập mối quan hệ.</div>
                                        </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="YearbirthEdit">Năm sinh:</label><br>
                                                <input type="text" id="YearbirthEdit" name="YearbirthEdit" placeholder="năm sinh">
                                                <div class="error-message" id="YearbirthEditError">Vui lòng nhập năm sinh.</div>
                                            </div>
                                            <div class="flex-item2">
                                                <label for="schoolEdit">Trường: </label><br>
                                                <input type="text" id="schoolEdit" name="schoolEdit" placeholder="Trường học" ><br>
                                                <div class="error-message" id="schoolEditError">Vui lòng nhập Trường học</div>
                                            </div>
                                            <div class="flex-item3">
                                                <label for="majorsEdit">Ngành học: </label><br>
                                                <input type="text" id="majorsEdit" name="majorsEdit" placeholder="Ngành học" ><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="AddressEdit">Địa chỉ hiện tại:</label><br>
                                                <input type="text" id="AddressEdit" name="AddressEdit" placeholder="Địa chỉ hiện tại" ><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                        <div class="flex-item1">
                                            <label for="phoneNumberEdit">Số điện thoại:</label><br>
                                            <input type="tel" id="phoneNumberEdit" name="phoneNumberEdit" pattern="[0-9]{10}" placeholder="Số điện thoại" ><br>
                                        </div>
                                        <div class="flex-item2">
                                            <label for="freetimeEdit">Thời gian rảnh: </label><br>
                                            <input type="text" id="freetimeEdit" name="freetimeEdit" placeholder="Thời gian rảnh"><br>
                                            <div class="error-message" id="freetimeEditError">Vui lòng nhập ngày sinh.</div>
                                        </div>
                                        </div> 
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="ProblemEdit">Vấn đề:</label><br>
                                                <input type="text" id="ProblemEdit" name="ProblemEdit" placeholder="Vấn đề"><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="levelEdit">Trình độ tiếng anh:</label><br>
                                                <input type="text" id="levelEdit" name="levelEdit" placeholder="Trình độ" ><br>
                                            </div> 
                                            <div class="flex-item2">
                                                <label for="demandEdit">Nhu cầu:</label><br>
                                                <input type="text" id="demandEdit" name="demandEdit" placeholder="Nhu cầu" ><br>
                                            </div> 
                                            <div class="flex-item3">
                                                <label for="targetEdit">Mục đích học:</label><br>
                                                <input type="text" id="targetEdit" name="targetEdit" placeholder="Mục đích học" ><br>
                                            </div> 
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="understandingEdit">Độ hiểu biết</label><br>
                                                <input type="text" id="understandingEdit" name="understandingEdit" placeholder="Độ hiểu biết" ><br>
                                            </div> 
                                            <div class="flex-item2">
                                                <label for="concernedEdit">Quan tâm gì về sản phẩm:</label><br>
                                                <input type="text" id="concernedEdit" name="concernedEdit" placeholder="Quan tâm" ><br>
                                            </div>  
                                            <div class="flex-item3">
                                                <label for="studytimeEdit">Thời điểm muốn học:</label><br>
                                                <input type="text" id="studytimeEdit" name="studytimeEdit" placeholder="Thời điểm muốn học" ><br>
                                            </div>  
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="circumstancesEdit">Hoàn cảnh:</label><br>
                                                <input type="text" id="circumstancesEdit" name="circumstancesEdit" placeholder="Hoàn cảnh" ><br>
                                            </div> 
                                            <div class="flex-item2">
                                                <label for="opinionEdit">Ý kiến gia đình:</label><br>
                                                <input type="text" id="opinionEdit" name="opinionEdit" placeholder="ý kiến gia đình" ><br>
                                            </div> 
                                            <div class="flex-item3">
                                                <label for="tuitionEdit">GD - Học phí:</label><br>
                                                <input type="text" id="tuitionEdit" name="tuitionEdit" placeholder="GD - Học phí" ><br>
                                            </div> 
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <label for="NoteEdit">Note:</label><br>
                                                <textarea id="noteEdit" name="noteEdit"></textarea><br>
                                            </div>
                                        </div>
                                        <div class="flex-container">
                                            <div class="flex-item1">
                                                <input type="submit" value="sửa">
                                            </div>    
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-setting" id="form-setting">
                <form action="" id="columnForm">
                    <label><input type="checkbox" class="toggleColumn" data-column="1" checked>ID</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="20">Sale</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="2"checked>Họ tên</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="21">SĐT</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="3"checked>Mối quan hệ</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="4"checked>Năm sinh</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="5"checked>Trường</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="6"checked>Ngành</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="7">Địa chỉ Hiện tại</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="8">Thời gian rảnh</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="9">Lời từ chối</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="10">Trình độ</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="11">Nhu cầu</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="12">Mục đích</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="13">Thời điểm học</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="14">Độ hiểu biết</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="15">QT về sản phẩm</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="16">Hoàn cảnh</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="17">ý kiến gia đình</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="18">GĐ_học phí</label><br>
                    <label><input type="checkbox" class="toggleColumn" data-column="19">Note</label><br>
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
    document.addEventListener('DOMContentLoaded', function() {
    // Lắng nghe sự kiện click trên tất cả các nút chỉnh sửa
        var editButtons = document.querySelectorAll('.editButton');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Lấy giá trị ID của nhân viên từ thuộc tính data-id
                var listcostomers_Id = this.getAttribute('data-id');
                // Gửi yêu cầu AJAX đến tập tin PHP xử lý
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'edi_costomers.php?id=' + listcostomers_Id, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Parse dữ liệu nhận được từ response
                        var data = JSON.parse(xhr.responseText);
                        console.log(data);
                        
                        // Danh sách các cặp ID và thuộc tính dữ liệu tương ứng
                        var elementsMap = {
                            'listcostomersIdEdit': 'ID',
                            'fullnameEdit': 'Name',
                            'RelationshipEdit': 'Relationship',
                            'YearbirthEdit': 'Year_birth',
                            'schoolEdit': 'school',
                            'majorsEdit': 'majors',
                            'AddressEdit': 'Address',
                            'phoneNumberEdit': 'phoneNumber',
                            'freetimeEdit': 'free_time',
                            'ProblemEdit': 'Problem',
                            'levelEdit': 'level',
                            'demandEdit': 'customer_need',
                            'targetEdit': 'Target',
                            'understandingEdit': 'level_understanding',
                            'concernedEdit': 'concerned',
                            'studytimeEdit': 'Study_time',
                            'circumstancesEdit': 'family_circumstances',
                            'opinionEdit': 'family_opinion',
                            'tuitionEdit': 'family_tuition',
                            'noteEdit': 'note'
                        };

                        // Hiển thị thông tin của nhân viên trong form chỉnh sửa
                        for (var elementId in elementsMap) {
                            if (elementsMap.hasOwnProperty(elementId)) {
                                var element = document.getElementById(elementId);
                                if (element) {
                                    var dataProperty = elementsMap[elementId];
                                    element.value = data[dataProperty] || '';
                                } else {
                                    console.error('Không tìm thấy phần tử với ID ' + elementId + '.');
                                }
                            }
                        }

                        // Hiển thị modal chỉnh sửa
                        var editModal = document.getElementById('Editmodal');
                        if (editModal) {
                            editModal.style.display = 'block';
                        } else {
                            console.error('Không tìm thấy phần tử với ID Editmodal.');
                        }
                    } else {
                        // Hiển thị thông báo lỗi
                        alert('Có lỗi xảy ra khi tải thông tin nhân viên.');
                    }
                };
                xhr.send();
            });
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

    // Loại bỏ dấu phân cách hàng nghìn trước khi gửi biểu mẫu
    document.getElementById('myForm').addEventListener('submit', function(event) {
        amountInputs.forEach(input => {
            input.value = input.value.replace(/[^0-9]/g, '');
        });
    });

    document.getElementById('Edit').addEventListener('submit', function(event) {
        amountInputs.forEach(input => {
            input.value = input.value.replace(/[^0-9]/g, '');
        });
    });
    btn.addEventListener('click', btnform);

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
