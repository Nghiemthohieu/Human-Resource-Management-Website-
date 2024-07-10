<?php
// Kết nối cơ sở dữ liệu
require_once 'conn_salary.php';
// Kiểm tra xem có dữ liệu nhận được không
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    // Truy vấn cơ sở dữ liệu để lấy thông tin nhân viên dựa trên ID
    $query = "SELECT
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
    soft_salary ss ON p.ID_position = ss.ID_position;";
    $result = mysqli_query($conn, $query);
    // Kiểm tra xem có kết quả trả về không
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Trả về dữ liệu dưới dạng JSON
        echo json_encode($row);
    } else {
        // Trường hợp không tìm thấy nhân viên
        echo json_encode(['error' => 'Không tìm thấy thông tin nhân viên']);
    }
} else {
    // Trường hợp không có dữ liệu nhận được
    echo json_encode(['error' => 'Không nhận được dữ liệu nhân viên']);
}
?>