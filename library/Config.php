<?php
require_once("library/OES.php");
require_once("library/Database.php");
date_default_timezone_set('Asia/Manila');
/*ini_set('display_errors', 0);
error_reporting(0);*/


/*
$mysql_host = "mysql8.000webhost.com";
$mysql_database = "a7193628_oes";
$mysql_user = "a7193628_oes";
$mysql_password = "oesdb2015";

*/
$mysql_host = "localhost";
$mysql_database = "dlsudhs";
$mysql_user = "root";
$mysql_password = "";


$oes_db = new Database($mysql_user, $mysql_password, $mysql_host, $mysql_database);
$oes_db->ConnectDB();
$oes = new OES();

session_start();
$loggedIn = false;

// Assigning of icons for menu
$menuIcon = array(
	"Dashboard" => "ic_dashboard_white",
	"Account" => "ic_account_circle_white",
	"Assessment" => "ic_payment_white",
	"Enrollment" => "ic_face_white",
	"Schedule" => "ic_schedule_white",
	"Grades" => "ic_assessment_white",
	"Users" => "ic_supervisor_account_white",
	"Groups" => "ic_supervisor_account_white",
	"Master Data" => "ic_dns_white",
	"Student" => "ic_perm_identity_white",
	"Faculty" => "ic_perm_identity_white",
	"College" => "ic_supervisor_account_white",
	"Course" => "ic_supervisor_account_white",
	"Building" => "ic_city_white",
	"Department" => "ic_perm_contact_calendar_white",
	"Room" => "ic_crop-free_white"
);

if(isset($_SESSION['loggedID'])) {
	$loggedIn = true;
	$oes->loggedUser($_SESSION["loggedID"]);
	if(isset($_GET['logout'])) {
		header("Location: process.php?action=logout");
	}
}


?>