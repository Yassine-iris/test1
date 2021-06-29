<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get posted data
    $data = json_decode(file_get_contents("php://input", true));

    $sql = "INSERT INTO task(USer_id,Title,Description,Status) VALUES(
        '" . mysqli_real_escape_string($dbConn, $data->User_id) . "',
        '" . mysqli_real_escape_string($dbConn, $data->Title) . "',
        '" . mysqli_real_escape_string($dbConn, $data->Description) . "',
        '" . mysqli_real_escape_string($dbConn, $data->Status) . "')";
    dbQuery($sql);
}
