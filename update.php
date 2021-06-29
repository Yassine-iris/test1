<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));

	$sql = "UPDATE user SET 
                   name = '" . mysqli_real_escape_string($dbConn, $data->name) . "' ,
                   email = '" . mysqli_real_escape_string($dbConn, $data->email) . "'
	               WHERE id = " . $data->id;
	dbQuery($sql);
}
