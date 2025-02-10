<?php
$month = isset($_GET['month']) ? $_GET['month'] : date('n');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

$prev_month = $month - 1;
$prev_year = $year;
if ($prev_month == 0) {
    $prev_month = 12;
    $prev_year--;
}

$next_month = $month + 1;
$next_year = $year;
if ($next_month == 13) {
    $next_month = 1;
    $next_year++;
}

$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$first_day = date('N', strtotime("$year-$month-01"));
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <style>
        table { width: 100%; text-align: center; }
        td { padding: 10px; border: 1px solid #ccc; }
        .today { background-color: yellow; }
    </style>
</head>
<body>

    <h2>
        <a href="?month=<?= $prev_month ?>&year=<?= $prev_year ?>">⬅</a>
        <?= date('F Y', strtotime("$year-$month-01")) ?>
        <a href="?month=<?= $next_month ?>&year=<?= $next_year ?>">➡</a>
    </h2>

    <table>
        <tr>
            <th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th>
        </tr>
        <tr>
            <?php
            $day_count = 1;
            for ($i = 1; $i < $first_day; $i++) {
                echo "<td></td>";
            }
            for ($i = $first_day; $i <= 7; $i++) {
                $class = ($day_count == date('j') && $month == date('n') && $year == date('Y')) ? "class='today'" : "";
                echo "<td $class>$day_count</td>";
                $day_count++;
            }
            echo "</tr>";

            while ($day_count <= $days_in_month) {
                echo "<tr>";
                for ($i = 1; $i <= 7 && $day_count <= $days_in_month; $i++) {
                    $class = ($day_count == date('j') && $month == date('n') && $year == date('Y')) ? "class='today'" : "";
                    echo "<td $class>$day_count</td>";
                    $day_count++;
                }
                echo "</tr>";
            }
            ?>
    </table>

</body>
</html>
