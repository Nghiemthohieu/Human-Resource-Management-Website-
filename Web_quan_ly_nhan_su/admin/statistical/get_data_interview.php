<?php
header('Content-Type: application/json');
require_once 'conn_statistical.php' ;

if (isset($_GET['year']) && isset($_GET['month'])) {
    $year = $_GET['year'];
    $month = $_GET['month'];

    if (is_numeric($year) && is_numeric($month) && $month >= 1 && $month <= 12) {
        $dateFormat = "{$year}-{$month}";

        $sql = "SELECT personnal.Name AS hr, COUNT(interview_schedule.ID_personnal) AS total_interview
                FROM interview_schedule JOIN personnal ON interview_schedule.ID_personnal=personnal.ID_personnal
                WHERE DATE_FORMAT(interview_schedule.date_interview, '%Y-%m') = ?
                GROUP BY interview_schedule.ID_personnal
                ORDER BY hr";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $dateFormat);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = array(
                    "name" => $row["hr"],
                    "y" => (int)$row["total_interview"]
                );
            }
        } else {
            $data[] = array(
                "name" => "No data",
                "y" => 0
            );
        }

        echo json_encode($data);
    } else {
        echo json_encode(array("error" => "Invalid year or month"));
    }
} else {
    echo json_encode(array("error" => "Year and month are required"));
}
?>
