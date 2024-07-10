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
            flex: 8;
            background-color: #ffffff;
            padding: 10px;
            border-bottom-right-radius: 15px;
            height: 100px;
        }
        .display-body #monthSelect{
            margin-left: 10px;
            width: 50px;
        }
        .display-body #yearSelect
        {
            width: 70px;
            margin-left: 10px;
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
            top: 10%;
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
        .table table tr {
            border: 1px solid;
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
          <h2>Lương</h2>
        </div>
        <div class="display-body">
            <div class="search">
                <div class="search-container" id="searchContainer">
                    <button id="searchButton" onclick="toggleSearch()"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" id="searchInput" placeholder="Nhập từ khóa">
                </div>
                <form id="reportForm" method="GET" action="">
                    <select id="yearSelect" name="yearSelect"></select>
                    <select id="monthSelect" name="monthSelect"></select>
                </form>
            </div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th>Mã key</th>
                            <th>số công</th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                        // Kết nối cơ sở dữ liệu
                        include "../includes/conn.php";

                        // function getAllSubTeams($conn, $parent_team_id) {
                        //     $sub_teams = [];
                        //     $sql = "WITH RECURSIVE team_hierarchy AS (
                        //                 -- Bắt đầu từ nhóm gốc dựa trên ID được cung cấp
                        //                 SELECT
                        //                     t.ID,
                        //                     t.ID_teams,
                        //                     t.ID_personnal
                        //                 FROM
                        //                     teams t
                        //                 WHERE
                        //                     t.ID_teams = $parent_team_id
                                        
                        //                 UNION ALL
                                        
                        //                 -- Đệ quy để lấy tất cả các nhóm con
                        //                 SELECT
                        //                     t.ID,
                        //                     t.ID_teams,
                        //                     t.ID_personnal
                        //                 FROM
                        //                     teams t
                        //                 INNER JOIN team_hierarchy th ON t.ID_teams = th.ID_personnal
                        //             )
                        //             SELECT
                        //                 p.ID_personnal
                        //             FROM
                        //                 team_hierarchy th
                        //             JOIN
                        //                 personnal p ON th.ID_personnal = p.ID_personnal
                        //             WHERE
                        //                 p.ID_status = 1;";
                        //     $result = $conn->query($sql);

                        //     if ($result->num_rows > 0) {
                        //         while($row = $result->fetch_assoc()) {
                        //             $sub_teams[] = $row["ID_personnal"];
                        //             $sub_teams = array_merge($sub_teams, getAllSubTeams($conn, $row["ID_personnal"]));
                        //         }
                        //     }

                        //     return $sub_teams;
                        // }

                        // Lấy giá trị năm và tháng từ form
                        $selectedYear = isset($_GET['yearSelect']) ? $_GET['yearSelect'] : date('Y');
                        $selectedMonth = isset($_GET['monthSelect']) ? $_GET['monthSelect'] : date('m');

                        // Định dạng năm và tháng cho SQL
                        $formattedDate = $selectedYear . '-' . $selectedMonth;

                        // // ID của team chính
                        // $main_team_id = htmlspecialchars($_SESSION['user_id']);

                        // // Lấy tất cả các team con của team chính
                        // $team_ids = getAllSubTeams($conn, $main_team_id);
                        // $team_ids[] = $main_team_id; // Bao gồm cả team chính

                        // // Chuyển mảng team_ids thành chuỗi để sử dụng trong câu lệnh SQL
                        // $team_ids_str = implode(',', $team_ids);

                        // Câu lệnh SQL
                        $listcostomers_sql = "
                            SELECT 
                                ID_personnal, 
                                COUNT(*) AS attendance_count
                            FROM 
                                timekeeping
                            WHERE 
                                DATE_FORMAT(date, '%Y-%m') = '$formattedDate'
                                    AND ((check_in >= '07:00:00' AND check_in <= '08:00:00' AND check_out >= '11:00:00') OR
                                        (check_in >= '13:00:00' AND check_in <= '14:00:00' AND check_out >= '17:00:00') OR
                                        (check_in >= '17:00:00' AND check_in <= '18:00:00' AND check_out >= '21:00:00'))
                            GROUP BY 
                                ID_personnal;
                        ";
                        // Thực thi câu lệnh
                        $result = mysqli_query($conn, $listcostomers_sql);

                        // Duyệt qua result và in ra
                        function formatCurrency($amount) {
                            return number_format($amount, 0, ',', '.');
                        }
                        
                        while ($r = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $r['ID_personnal']; ?></td>
                                        <td><?php echo $r['attendance_count']; ?></td>
                                    </tr>
                                    <?php
                        }
                        ?>
                    </tbody>
                </table>
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
    document.addEventListener("DOMContentLoaded", function() {
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0

        const yearSelect = document.getElementById('yearSelect');
        const monthSelect = document.getElementById('monthSelect');

        const form = document.getElementById('reportForm');

        for (let year = currentYear - 10; year <= currentYear + 10; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            if (year === <?php echo $selectedYear; ?>) {
                option.selected = true;
            }
            yearSelect.appendChild(option);
        }

        for (let month = 1; month <= 12; month++) {
            const option = document.createElement('option');
            option.value = month.toString().padStart(2, '0');
            option.textContent = month;
            if (month === <?php echo $selectedMonth; ?>) {
                option.selected = true;
            }
            monthSelect.appendChild(option);
        }

        // Add event listeners to year and month dropdowns
        yearSelect.addEventListener('change', function() {
            form.submit(); // Submit the form when year changes
        });

        monthSelect.addEventListener('change', function() {
            form.submit(); // Submit the form when month changes
        });
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
