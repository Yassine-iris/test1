<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // get posted data
    $data = json_decode(file_get_contents("php://input", true));

    $sql = "UPDATE task SET 
                User_id = '" . mysqli_real_escape_string($dbConn, $data->User_id) . "' ,
                Title = '" . mysqli_real_escape_string($dbConn, $data->Title) . "' ,
                Description = '" . mysqli_real_escape_string($dbConn, $data->Description) . "',
                Status = '" . mysqli_real_escape_string($dbConn, $data->Status) . "' 
                WHERE IdT = " . $data->IdT;
    dbQuery($sql);
}

