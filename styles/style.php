<?php 
header("Content-type: text/css"); 
if(isset($_GET['primary']))
	$__PRIMARY_COLOR = "#".$_GET['primary'];
else
	$__PRIMARY_COLOR = "#0f8a43"; 

if(isset($_GET['secondary']))
	$__SECONDARY_COLOR = "#".$_GET['secondary'];
else
	$__SECONDARY_COLOR = "#86c522"; 
$__MIN_WEBSITE_WIDTH = "360px"; 
$__MAX_WEBSITE_WIDTH = "960px"; 

function getTransition($attr, $time, $speed) {
	$x = "-webkit-transition: all time speed; 
	-moz-transition: all time speed; 
	-ms-transition: all time speed; 
	-o-transition: all time speed; 
	transition: all time speed;
"; 
	$x = str_replace("time", $time, $x); 
	$x = str_replace("speed", $speed, $x); 
	$x = str_replace("all", $attr, $x); 
	echo $x; 
} 
function getRotation($deg) {
	$x = "-webkit-transform: rotate(360deg); 
	-moz-: rotate(360deg); 
	-ms-transform: rotate(360deg);
	-o-transform: rotate(360deg); 
	transform: rotate(360deg);
"; 
	$x = str_replace("360", $deg, $x); 
	echo $x;
} 
function getBackgroundIcon($icon, $color) {
	echo 'background-image: url(../../../images/skin/oslo/icons/ic_'.$icon.'_'.$color.'.png);';
} 
?> 
.profpic {
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center center;
}
.profpic.small {
	width: 24px;
	height: 24px;
	border-radius: 100%;
	display: inline-block;
	vertical-align: middle;
	margin-right: 10px;
}
.profpic.medium {
	width: 36px;
	height: 36px;
	border-radius: 100%;
	display: inline-block;
	vertical-align: middle;
	margin-right: 10px;
}
.profpic.large {
	width: 48px;
	height: 48px;
	border-radius: 100%;
	display: inline-block;
	vertical-align: middle;
	margin-right: 10px;
}
#action-bar .actions span.profpic {
	position: absolute;
	width: 36px;
	height: 36px;
	left: 50%;
	margin-left: -18px;
	border-radius: 100%;
}
ul.list li .primary [class^="flat_icon"] {
	display: inline-block;
	float: left;
}
div.table {
	display: table;
	width: 100%;
	padding: 0px;
	margin: 0px;
}
div.table div.row {
	display: table-row;
}
div.table div.row div.cell {
	display: table-cell;
	padding: 5px;
}
div.table div.row div.cell.right {
	text-align: right;
}
div.table div.row div.cell.middle {
	vertical-align: middle;
}
div.table div.row div.cell.w1 {
	width: 1px;
}
div.table div.row div.cell.invisible {
	visibility: hidden;
}