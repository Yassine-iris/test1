<?php
ini_set("date.timezone", "Europe/Paris");

    
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbWebsite = "managerone_test";


$copyright = "© 2021 ManagerOne - By Yassine - 
";



try 
{
	$websiteDB = new PDO("mysql:host=$dbHost;dbname=$dbWebsite;charset=utf8", "$dbUser", "$dbPass");
	
}
catch(PDOException $ex)
{
	header("Location: ./maintenance.php");
	exit;
}
