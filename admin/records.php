<?php

include ('include/record.php');

$model = new Model();
// $grandTotal = 0;
// foreach ($data as $row) {
//     $grandTotal += $row['price'];
// }

// // Store the grand total in a session variable
// $_SESSION['grandTotal'] = $grandTotal;

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $rows = $model->date_range($start_date, $end_date);
} else {
    $rows = $model->fetch();
}

echo json_encode($rows);