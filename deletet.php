<?php

require_once 'db.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['IdT'])) {
    $sql = "DELETE FROM task WHERE IdT = " . mysqli_real_escape_string($dbConn, $_GET['IdT']);
    dbQuery($sql);
}
