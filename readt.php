<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['IdT'])) {
    $sql = "SELECT * FROM task WHERE id = " . mysqli_real_escape_string($dbConn, $_GET['IdT']) . " LIMIT 1";
    $result = dbQuery($sql);

    $row = dbFetchAssoc($result);

    echo json_encode($row);
} else {
    $sql = "SELECT * FROM task";
    $results = dbQuery($sql);

    $rows = array();

    while($row = dbFetchAssoc($results)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
}
