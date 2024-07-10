<?php
session_start();
include '../funtion.php';
$regexResult=checkPrivilege();
if(!$regexResult){
    echo("Bạn không có quyền truy cập trnag wed này!");exit;
}
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
            border-top-left-radius: 15px;
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
        .menu {
            height: 378px;
            overflow-y: scroll;
            max-height: calc(100%);
        }
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: grey;
        }
        .log-out button {
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
        .menu-box button:hover {
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
        .menu-box button:hover {
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
        .menu-box button span {
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
            padding-bottom: 20px; /* Thêm khoảng cách dưới */
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
            position: relative;
            flex: 8;
            background-color: #ffffff;
            padding: 10px;
            border-bottom-right-radius: 15px;
            height: 378px;
            overflow-y: scroll;
            max-height: calc(100%);
        }
        .annual-sales-chart {
            width: 90%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Thêm khoảng cách dưới */
            position: relative; /* Đổi từ absolute sang relative */
            left: 5%;
        }
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        #totalSales {
            text-align: center; /* Căn giữa nội dung của phần tử */
            margin-top: 10px; /* Khoảng cách từ phần tử trên xuống */
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
            <h2>Thống kê</h2>
            </div>
            <div class="display-body">
                <?php if(checkPrivilege('get_sales_data.php')) { ?>
                <div class="annual-sales-chart">
                    <figure class="highcharts-figure">
                        <!-- Thêm phần select để chọn năm -->
                        <select id="yearSelect"></select>
                        <!-- Thêm phần container cho biểu đồ -->
                        <div id="container"></div>
                        <div id="totalSales"></div>
                    </figure>
                </div>
                <?php } ?>
                <?php if(checkPrivilege('get_data_interview.php')) { ?>
                <div class="annual-sales-chart">
                    <figure class="highcharts-figure">
                        <select id="yearSelect2"></select>
                        <select id="monthSelect2"></select>
                        <div id="container1"></div>
                    </figure>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        // Hàm tạo danh sách các năm
        function populateYearSelect() {
            const yearSelect = document.getElementById('yearSelect');
            const currentYear = new Date().getFullYear();

            for (let year = currentYear; year >= 2000; year--) { // Từ năm 2000 đến năm hiện tại
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                yearSelect.appendChild(option);
            }
        }

        // Gọi hàm populateYearSelect khi trang được tải
        document.addEventListener('DOMContentLoaded', populateYearSelect);

        // Hàm vẽ biểu đồ
        function drawChart(data, selectedYear) {

            const dataInMillions = data.map(value => value / 1000000);

            // Tính tổng doanh số
            const totalSales = data.reduce((acc, curr) => acc + curr, 0);

            // Hiển thị tổng doanh số với năm tương ứng
            const totalSalesText = `Tổng doanh số năm ${selectedYear}: ${Highcharts.numberFormat(totalSales / 1000000, 2)} triệu VNĐ`;
            document.getElementById('totalSales').textContent = totalSalesText;

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: `Doanh số kinh doanh, ${selectedYear}`,
                    align: 'left'
                },
                xAxis: [{
                    categories: [
                        'T1', 'T2', 'T3', 'T4', 'T5', 'T6',
                        'T7', 'T8', 'T9', 'T10', 'T11', 'T12'
                    ],
                    crosshair: true
                }],
                yAxis: [{ 
                    title: {
                        text: '',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: '{value}tr VNĐ',
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    }
                }],
                tooltip: {
                    shared: true
                },
                legend: {
                    align: 'left',
                    x: 80,
                    verticalAlign: 'top',
                    y: 60,
                    floating: true,
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'rgba(255,255,255,0.25)'
                },
                series: [{
                    name: 'Doanh số',
                    type: 'column',
                    data: dataInMillions,
                    tooltip: {
                        valueSuffix: 'tr VNĐ'
                    }
                }]
            });
        }

        // Hàm load dữ liệu từ server
        function loadData(year) {
            fetch(`get_sales_data.php?year=${year}`)
                .then(response => response.json())
                .then(data => {
                    drawChart(data, year);
                })
                .catch(error => console.error('Error loading data:', error));
        }

        // Sự kiện thay đổi năm
        document.getElementById('yearSelect').addEventListener('change', function() {
            const year = this.value;
            loadData(year);
        });

        // Tải dữ liệu mặc định ban đầu
        document.addEventListener('DOMContentLoaded', () => {
            const defaultYear = new Date().getFullYear();
            loadData(defaultYear);
            document.getElementById('yearSelect').value = defaultYear;
        });

        document.addEventListener("DOMContentLoaded", function() {
            const currentDate = new Date();
            const currentYear = currentDate.getFullYear();
            const currentMonth = currentDate.getMonth() + 1; // Tháng bắt đầu từ 0

            const yearSelect = document.getElementById('yearSelect2');
            const monthSelect = document.getElementById('monthSelect2');

            for (let year = currentYear - 10; year <= currentYear + 10; year++) {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                if (year === currentYear) {
                    option.selected = true;
                }
                yearSelect.appendChild(option);
            }

            for (let month = 1; month <= 12; month++) {
                const option = document.createElement('option');
                option.value = month.toString().padStart(2, '0');
                option.textContent = month;
                if (month === currentMonth) {
                    option.selected = true;
                }
                monthSelect.appendChild(option);
            }

            fetchDataAndRenderChart();

            yearSelect.addEventListener('change', fetchDataAndRenderChart);
            monthSelect.addEventListener('change', fetchDataAndRenderChart);
        });

        function fetchDataAndRenderChart() {
            const year = document.getElementById('yearSelect2').value;
            const month = document.getElementById('monthSelect2').value;

            fetch(`get_data_interview.php?year=${year}&month=${month}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error fetching data: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.length === 0) {
                        throw new Error('No data available');
                    }

                    Highcharts.chart('container1', {

                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: `Data tuyển dụng tháng ${month} - ${year}`
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        plotOptions: {
                            series: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: [{
                                    enabled: true,
                                    distance: 20
                                }, {
                                    enabled: true,
                                    distance: -40,
                                    format: '{point.percentage:.1f}%',
                                    style: {
                                        fontSize: '1.2em',
                                        textOutline: 'none',
                                        opacity: 0.7
                                    },
                                    filter: {
                                        operator: '>',
                                        property: 'percentage',
                                        value: 10
                                    }
                                }]
                            }
                        },
                        series: [{
                            name: 'số lượng data ',
                            colorByPoint: true,
                            data: data
                        }]
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
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
