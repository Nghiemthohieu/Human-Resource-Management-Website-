<?php
session_start();
include "../funtion.php";
include "../includes/conn.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
        .display-body button{
          width: 150px;
          height: 150px;
          margin: 10px;
          border-radius: 30px;
          box-shadow: 0px 0px 8px rgba(0,0,0,0.2);
          border: none;
          background-color: #D8D5FF;
          justify-content: center;
        }
        .display-body button:hover{
          opacity: 1;
          background-color: rgb(141 135 223 / 25%);
        }
        .display-body button i {
          font-size: 70px;
          padding: 10px 10px 10px 10px;
        }
        .display-body button p{
          font-size: 14px;
          margin: 0;
          font-weight: bold;
        }
        /* .login-box h2 {
             margin-bottom: 30px; 
            text-align: center;
        } */
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
          <h2>Trang chủ</h2>
        </div>
        <?php 
            $currentMonth = date('m');
            $currentYear = date('Y');
            $date = "{$currentYear}-{$currentMonth}";
            $id=$_SESSION['user_id'];
            // Query to fetch interview schedule
            $sql = mysqli_query($conn, "
            SELECT personnal.Name AS hr, COUNT(interview_schedule.ID_personnal) AS total_interview
            FROM interview_schedule
            JOIN personnal ON interview_schedule.ID_personnal = personnal.ID_personnal
            WHERE DATE_FORMAT(interview_schedule.date_interview, '%Y-%m') = '$date'
            AND interview_schedule.ID_personnal = '$id'
            GROUP BY interview_schedule.ID_personnal
            ORDER BY hr
            ");
            $r = mysqli_fetch_all($sql, MYSQLI_ASSOC);

            // Query to fetch personnel details
            $personnal = mysqli_query($conn, "
            WITH RECURSIVE team_hierarchy AS (
                -- Bắt đầu từ nhóm gốc dựa trên ID được cung cấp
                SELECT
                    t.ID,
                    t.ID_teams,
                    t.ID_personnal
                FROM
                    teams t
                WHERE
                    t.ID_teams = '$id'
                
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
                COUNT(DISTINCT p.ID_personnal) AS total_personnal
            FROM
                team_hierarchy th
            JOIN
                personnal p ON th.ID_personnal = p.ID_personnal
            WHERE
                p.ID_status = 1;
            ");
            $personnal = mysqli_fetch_all($personnal, MYSQLI_ASSOC);

            // Query to fetch sales data
            $DS = mysqli_query($conn, "
            SELECT
                p.ID_personnal,
                p.Name,
                COALESCE(ps.personal_sales, 0) AS personal_sales,
                COALESCE(ts.team_sales, 0) AS team_sales,
                COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0) AS total_sales,
                ROUND(
                    CASE
                        WHEN COALESCE(ps.personal_sales, 0) < 30000000 THEN COALESCE(ps.personal_sales, 0) * 0.06
                        WHEN COALESCE(ps.personal_sales, 0) BETWEEN 30000000 AND 70000000 THEN COALESCE(ps.personal_sales, 0) * 0.08
                        ELSE COALESCE(ps.personal_sales, 0) * 0.10
                    END,
                    2
                ) AS personal_salary,
                ROUND(
                    CASE
                        WHEN COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0) < ss.target_1 THEN (COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0)) * (ss.care_part_1 / 100)
                        WHEN COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0) BETWEEN ss.target_1 AND ss.target_2 THEN (COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0)) * (ss.care_part_2 / 100)
                        ELSE (COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0)) * (ss.care_part_3 / 100)
                    END,
                    2
                ) AS team_salary,
                ROUND(
                    (
                        CASE
                            WHEN COALESCE(ps.personal_sales, 0) < 30000000 THEN COALESCE(ps.personal_sales, 0) * 0.06
                            WHEN COALESCE(ps.personal_sales, 0) BETWEEN 30000000 AND 70000000 THEN COALESCE(ps.personal_sales, 0) * 0.08
                            ELSE COALESCE(ps.personal_sales, 0) * 0.10
                        END
                    ) +
                    (
                        CASE
                            WHEN COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0) < ss.target_1 THEN (COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0)) * (ss.care_part_1 / 100)
                            WHEN COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0) BETWEEN ss.target_1 AND ss.target_2 THEN (COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0)) * (ss.care_part_2 / 100)
                            ELSE (COALESCE(ps.personal_sales, 0) + COALESCE(ts.team_sales, 0)) * (ss.care_part_3 / 100)
                        END
                    ),
                    2
                ) AS total_salary
            FROM
                personnal p
            LEFT JOIN (
                SELECT
                    ID_persontion,
                    SUM(pay_money) AS personal_sales
                FROM
                    bill
                WHERE
                    DATE_FORMAT(Registration_Date, '%Y-%m') = '$date'
                GROUP BY
                    ID_persontion
            ) ps ON p.ID_personnal = ps.ID_persontion
            LEFT JOIN (
                SELECT
                    t.ID_teams,
                    SUM(b.pay_money) AS team_sales
                FROM
                    bill b
                JOIN
                    personnal p ON b.ID_persontion = p.ID_personnal
                JOIN
                    teams t ON p.ID_personnal = t.ID_personnal
                WHERE
                    DATE_FORMAT(b.Registration_Date, '%Y-%m') = '$date'
                GROUP BY
                    t.ID_teams
            ) ts ON p.ID_personnal = ts.ID_teams
            JOIN
                soft_salary ss ON p.ID_position = ss.ID_position
            WHERE
                p.ID_personnal = '$id'
            ");
            $DS = mysqli_fetch_all($DS, MYSQLI_ASSOC);
            // Function to format currency
            function formatCurrency($amount) {
                return number_format($amount, 0, ',', '.');
            }

            // Accessing and formatting the amount
            $amount = isset($DS[0]['total_sales']) ? $DS[0]['total_sales'] : 0;
            $formattedAmount1 = formatCurrency($amount);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            // Display results
            $current_time = date('H:i'); // Lấy thời gian hiện tại dưới định dạng giờ:phút
            // Kiểm tra thời gian hiện tại và xác định ca trực
            $shift = 'Ca chiều'; // Mặc định là ca chiều
            if ($current_time >= '00:00' && $current_time <= '11:30') {
                $shift = 'Ca sáng';
            }
            $current_date = date('Y-m-d');
            $duty_Calendar = mysqli_query($conn, "SELECT dutyschedule.*, personnal.Name AS personnal_name 
                                                    FROM dutyschedule 
                                                    JOIN personnal ON dutyschedule.ID_personnal = personnal.ID_personnal 
                                                    WHERE dutyschedule.date ='$current_date' AND dutyschedule.shift='$shift'");
            $duty_Calendar = mysqli_fetch_all($duty_Calendar, MYSQLI_ASSOC);
            ?>
            <div class="display-body">
            <?php if(checkPrivilege('salary.php')) { ?>
            <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/salary/salary.php'">
                <i class="fa-solid fa-chart-line"></i>
                <p>Doanh số hiện tại:</p>
                <p><?php echo $formattedAmount1 ?> VNĐ</p>
            </button>
            <?php } ?>
            <?php if(checkPrivilege('personnal.php')) { ?>
            <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/personnal/personnal.php'">
                <i class="fa-solid fa-users"></i>
                <p> Nhân sự: </p>
                <p><?php echo isset($personnal[0]['total_personnal']) ? $personnal[0]['total_personnal'] : 0; ?></p>
            </button>
            <?php } ?>
            <?php if(checkPrivilege('interview_schedule.php')) { ?>
            <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/interview_schedule/interview_schedule.php'">
                <i class="fa-solid fa-user-group"></i>
                <p>Lịch phỏng vấn: </p>
                <p><?php echo isset($r[0]['total_interview']) ? $r[0]['total_interview'] : 0; ?></p>
            </button>
            <?php } ?>
            <?php if(checkPrivilege('calendar_duty.php')) { ?>
            <button onclick="window.location.href='/Web_quan_ly_nhan_su/admin/calendar_duty/calendar_duty.php'">
                <i class="fa-solid fa-calendar-week"></i>
                <p>Lịch trực: </p>
                <p><?php echo isset($duty_Calendar[0]['personnal_name']) ? $duty_Calendar[0]['personnal_name'] : 0; ?></p>
            </button>
            <?php } ?>
        </div>
    </div>
</div>
<script>
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
