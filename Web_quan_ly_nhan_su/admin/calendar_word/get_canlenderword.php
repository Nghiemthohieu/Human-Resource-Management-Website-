<?php
include 'conn_calendarword.php';
session_start();

date_default_timezone_set('Asia/Ho_Chi_Minh');

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

$weekOffset = isset($_POST['weekOffset']) ? intval($_POST['weekOffset']) : 0;

$sql = "SELECT calendar.*, personnal.Name AS personnal_name, personnal.ID_personnal FROM calendar JOIN personnal ON calendar.ID_personnal = personnal.ID_personnal WHERE calendar.ID_personnal IN ($team_ids_str) ORDER BY date, shift";
$result = $conn->query($sql);

$work_schedule = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $work_schedule[$row["date"]][$row["shift"]][] = $row["personnal_name"];
    }

    $shifts = array("Ca sáng", "Ca chiều", "Ca tối");
    foreach ($shifts as $shift) {
        echo "<tr>";
        echo "<td class='work-shift'>$shift</td>";

        for ($i = 0; $i < 7; $i++) {
            $current_date = date('Y-m-d', strtotime('monday this week +' . $i . ' days ' . ($weekOffset * 7) . ' days'));

            echo "<td>";
            if (isset($work_schedule[$current_date]) && isset($work_schedule[$current_date][$shift])) {
                foreach ($work_schedule[$current_date][$shift] as $name) {
                    echo "<p>" . $name . "</p>";
                }
            }
            echo "</td>";
        }

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
}

$conn->close();
?>
