<?php
include 'conn_calendardyty.php';

$weekOffset = isset($_POST['weekOffset']) ? intval($_POST['weekOffset']) : 0;
// $weekOffset=-1;
// $weekOffset = isset($weekOffset);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$sql = "SELECT dutyschedule.*, personnal.Name AS personnal_name FROM dutyschedule JOIN personnal ON dutyschedule.ID_personnal = personnal.ID_personnal ORDER BY date, shift";
$result = $conn->query($sql);

$duty_schedule = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $duty_schedule[$row["date"]][$row["shift"]][] = $row["personnal_name"];
    }

    $shifts = array("Ca sáng", "Ca chiều");
    foreach ($shifts as $shift) {
        echo "<tr>";
        echo "<td class='work-shift'>$shift</td>";

        for ($i = 0; $i < 7; $i++) {
            $current_date = date('Y-m-d', strtotime('monday this week +' . $i . ' days ' . ($weekOffset * 7) . ' days'));

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
} else {
    echo "<tr><td colspan='8'>Không có dữ liệu</td></tr>";
}

$conn->close();
?>