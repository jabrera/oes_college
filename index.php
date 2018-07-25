<?php 
	$backDir = '';
	if(file_exists($backDir."library/Config.php")) {
		require_once($backDir."library/Config.php"); 
	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title>De La Salle University Dasmari&ntilde;as High School - Portal</title>
	<script src="<?php echo $backDir; ?>scripts/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/skin/light/">
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/style.php">
	<script src="<?php echo $backDir; ?>scripts/smooth_scroll.js"></script>
	<script src="<?php echo $backDir; ?>scripts/oslo-ui.js"></script>
</head>
<body name="tp">
<div id="app-container">
	<?php
	if($loggedIn) {
		$displayPage = "Dashboard";
		if($oes->getLoggedUserInfo("Type") == "Administrator") {
			$mainMenu = array(
				"Dashboard",
				"Account",
				array(
					"Administration",
					array(
						"School Year", 
						"Term", 
						"Pre Registration", 
						"Registration", 
						"Payment"
					)
				),
				array("Student",
					array(
						"Student Master Data"
					)
				),
				array("Faculty",
					array(
						"Faculty Master Data",
						"Adviser"
					)
				),
				array("College",
					array(
						"College Master Data"
					)
				),
				array("Course",
					array(
						"Course Master Data",
						"Section Master Data"
					)
				),
				array("Curriculum",
					array(
						"Curriculum Master Data",
						"Subject Master Data"
					)
				),
				array("Department",
					array(
						"Department Master Data"
					)
				),
				array("Location",
					array(
						"Building Master Data",
						"Room Master Data"
					)
				),
			);
			foreach ($mainMenu as $menu) {
				if(is_array($menu)) {
					foreach($menu[1] as $submenu) {
						if(isset($_GET[str_replace(" ", "-", strtolower($submenu))])) {
							$displayPage = $submenu;
							break;
						}
					}
				} else {
					if(isset($_GET[str_replace(" ", "-", strtolower($menu))])) {
						$displayPage = $menu;
						break;
					}
				}
			}
		}
		$pageCode = str_replace(" ", "-", strtolower($displayPage));
		require_once("template/".$oes->getLoggedUserInfo("Type")."/action-bar.php");
		require_once("template/".$oes->getLoggedUserInfo("Type")."/float-left-menu.php");
		if(file_exists("template/".$oes->getLoggedUserInfo("Type")."/".$pageCode.".php"))
			require_once("template/".$oes->getLoggedUserInfo("Type")."/".$pageCode.".php");
		else
			require_once("template/notfound.php");
	} else {
		require_once("login.php");
	}
	?>
	<div id="blackTrans" onclick="showElement('none')"></div>
	<div id="bottom-sheet"><div class="loading"></div></div>
	<div id="dialog-box">
		<div class="wrapper">
			<center><div class="loading"></div></center>
		</div>
	</div>
	<div id="snackbar">
		<div class="wrapper">
		</div>
	</div>
	<div id="loading"></div>
	<div id="data-action-bar">
		<div class="row">
			<div class="menu-title">
				<ul>
					<li><span class="title"></span></li>
				</ul>
			</div>
			<div class="actions">
				<ul>
					<li><a id="btnSelectAll" class="icons action_icon ic_select-all_black gray_icon icon_medium"></a></li>
					<li><a id="btnSelectOff"class="icons action_icon ic_select-off_black gray_icon icon_medium"></a></li>
					<li><a class="icons action_icon ic_dots-vertical_black gray_icon icon_medium"></a>
					<ul class="dropdownlist" id="actions">

					</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
if($loggedIn) {
	$profpic = "images/users/".$_SESSION['loggedID'].".jpg";
	if(!file_exists($profpic)) 
		$profpic = "images/users/unknown.jpg";
?>
<style type="text/css">
.my.profpic {
	background-image: url(<?php echo $profpic; ?>);
}
</style>
<?php
}
?>
</body>
</html>