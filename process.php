<?php
$backDir = '';
if(file_exists($backDir."library/Config.php"))
	require_once($backDir."library/Config.php"); 


function showSnackbar($show) {
	echo '<script>showSnackbar("'.$show.'");</script>';
}
function showSnackbarMsg($show) {
	echo '<script>showSnackbarMsg("'.$show.'");</script>';
}

function scriptCheckedData() {
?>
	<script>
	$(document).ready(function() {
		$("#chkAll input").change(function() {
			if(this.checked) {
				$(".checkData input").each(function() {
					if(!this.checked) {
						$checkedData.push($(this).attr("value"));
					}
				});
			} else {
				$(".checkData input").each(function() {
					$index = $checkedData.indexOf($(this).attr("value"));
					$checkedData.splice($index, 1);
				});
			}
			if(this.checked) {
				$(".checkData input").prop("checked", true);
			} else {
				$(".checkData input").prop("checked", false);
			}
			updateDataAction();
		});
		$(".checkData input").change(function() {
			$n = 1;
			$num = 0;
			$(".checkData input").each(function() {
				if(!this.checked)
					$n = 0;
				else
					$num++;
			});
			if(this.checked) {
				$checkedData.push($(this).attr("value"));
			} else {
				$index = $checkedData.indexOf($(this).attr("value"));
				$checkedData.splice($index, 1);
			}
			if($n == 1)
				$("#chkAll input").prop("checked", true);
			else
				$("#chkAll input").prop("checked", false);
			updateDataAction();
		});
	});
	function updateDataAction() {
		if($checkedData.length != 0) {
			$("#data-action-bar .menu-title .title").html($checkedData.length + " selected");
			showDataAction(true);
		} else {
			$("#numDataSelected").html("");
			showDataAction(false);
		}
	}
	$("#data-action-bar #btnSelectAll").click(function() {
		$(".checkData input").each(function() {
			if(!this.checked) {
				$checkedData.push($(this).attr("value"));
			}
		});
		$("#chkAll input").prop("checked", true);
		$(".checkData input").prop("checked", true);
		updateDataAction();
	});
	$("#data-action-bar #btnSelectOff").click(function() {
		deselectData();
	});
	function deselectData() {
		$checkedData = [];
		$("#chkAll input").prop("checked", false);
		$(".checkData input").prop("checked", false);
		updateDataAction();
	}
	</script>
<?php
}
function showPagination($query, $filter, $rowPerPage, $p, $refreshList) {
?>
	<div class="card button-container">
		<?php
		$query = mysql_query("$query $filter");
		$totalRecords = mysql_num_rows($query);
		$totalPages = 1;
		if($rowPerPage != 0)
			$totalPages = ceil($totalRecords / $rowPerPage);
		?>
		<div class="table">
			<div class="row">
				<div class="cell compact">
					<ul class="button-container divider">
						<li><a <?php if($p != 1) echo 'id="btnFirst" '; ?>onclick class="flat_button"><span class="flat_icon ic_double-left compact"></span></a></li>
						<li><a <?php if($p != 1) echo 'id="btnPrev" '; ?>onclick class="flat_button"><span class="flat_icon ic_left compact"></span></a></li>
					</ul>
				</div>
				<div class="cell">
					<select id="ddlPage">
						<?php
						for($i = 1; $i <= $totalPages; $i++) {
							$selected = "";
							if($p == $i) {
								$selected = " selected";
							}
							echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
						}
						?>
					</select>
				</div>
				<div class="cell compact">
					<ul class="button-container right divider">
						<li><a <?php if($p != $totalPages) echo 'id="btnNext" '; ?>onclick class="flat_button"><span class="flat_icon ic_right compact"></span></a></li>
						<li><a <?php if($p != $totalPages) echo 'id="btnLast" '; ?>onclick class="flat_button"><span class="flat_icon ic_double-right compact"></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<script>
		$(document).ready(function() {
			$("#btnFirst").click(function() {
				$("#frmSearch input[name='p']").val(1);
				<?php echo $refreshList; ?>
			});
			$("#btnPrev").click(function() {
				$("#frmSearch input[name='p']").val(parseInt($("#frmSearch input[name='p']").val(), 10)-1);
				<?php echo $refreshList; ?>
			});
			$("#btnNext").click(function() {
				$("#frmSearch input[name='p']").val(parseInt($("#frmSearch input[name='p']").val(), 10)+1);
				<?php echo $refreshList; ?>
			});
			$("#btnLast").click(function() {
				$("#frmSearch input[name='p']").val(<?php echo $totalPages; ?>);
				<?php echo $refreshList; ?>
			});
			$("#ddlPage").change(function() {
				$val = $(this).val();
				$("#frmSearch input[name='p']").val($val);
				<?php echo $refreshList; ?>
			});
		});
		</script>
	</div>
<?php
}




if(isset($_GET['action'])) {
	$action = $_GET['action'];
	if($action == "show-bottom-sheet") {
		if(isset($_POST['name'])) {
			$name = $_POST['name'];
			if(isset($_POST['id'])) 
				$bs_id = $_POST['id'];
			if(file_exists("content/bottom-sheet/$name.php"))
				require_once("content/bottom-sheet/$name.php");
			else
				require_once("content/bottom-sheet/null.php");
		} else 
			require_once("content/bottom-sheet/null.php");
	} elseif($action == "show-dialog-box") {
		if(isset($_POST['name'])) {
			$name = $_POST['name'];
			if(isset($_POST['id'])) 
				$db_id = $_POST['id'];
			if(file_exists("content/dialog-box/$name.php"))
				require_once("content/dialog-box/$name.php");
			else 
				require_once("content/dialog-box/null.php");
		} else 
			require_once("content/dialog-box/null.php");
	} elseif($action == "show-snackbar") {
		if(isset($_POST['name'])) {
			$name = $_POST['name'];
			if(isset($_POST['id'])) 
				$sb_id = $_POST['id'];
			if(file_exists("content/snackbar/$name.php"))
				require_once("content/snackbar/$name.php");
			else 
				require_once("content/snackbar/null.php");
		} else 
			require_once("content/snackbar/null.php");
	} elseif($action == "login") {
		if(isset($_POST['oes_username'], $_POST['oes_password'])) {
			$username = mysql_escape_string($_POST['oes_username']);
			$password = mysql_escape_string($_POST['oes_password']);
			$query = mysql_query("SELECT * FROM Account WHERE Username = '$username' AND Password = '$password'");
			while($row = mysql_fetch_array($query)) {
				$oes = new OES();
				$_SESSION["loggedID"] = $oes->getID($username);
				$oes->loggedUser($_SESSION["loggedID"]);
			}
		}
		header("Location: index.php");
	} elseif($action == "logout") {
		session_destroy();
		header("Location: index.php");
	} elseif($action == "getcollege") {
		if(isset($_POST['alloption'])) {
			echo '<option value="all">All colleges</option>';
		}
		$colleges = $oes->getData("College", "*", "");
		foreach($colleges as $college) {
			echo '<option value="'.$college["ID"].'">'.$college["Code"].'</option>';
		}
	} elseif($action == "getcourse") {
		if(isset($_POST['collegeID'])) {
			$collegeID = $_POST['collegeID'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All courses</option>';
			if(isset($_POST['nooption']))
				echo '<option value="null">No course</option>';
			if($collegeID == "all") {
				$courses = $oes->getData("Course", "*", "");
			} else {
				$courses = $oes->getData("Course", "*", "CollegeID = '$collegeID' ORDER BY Name");
			}
			foreach($courses as $course) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($course["ID"] == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$course["ID"].'"'.$selected.'>'.$course["Code"].'</option>';
			}
		}
	} elseif($action == "getterm") {
		if(isset($_POST['term'])) {
			$term = $_POST['term'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All courses</option>';
			if(isset($_POST['nooption']))
				echo '<option value="null">No course</option>';
			$termtext = array("1st Semester", "2nd Semester", "3rd Semester", "Summer Term");
			for($i = 1; $i <= 4; $i++) {
				$selected = "";
				if($i == $term) 
					$selected = " selected";
				echo '<option value="'.$i.'"'.$selected.'>'.$termtext[$i-1].'</option>';
			}
		}
	} elseif($action == "getdepartment") {
		if(isset($_POST['collegeID'])) {
			$collegeID = $_POST['collegeID'];
			if(isset($_POST['nooption']))
				echo '<option value="null">No department</option>';
			if(isset($_POST['alloption']))
				echo '<option value="all">All departments</option>';
			if($collegeID == "all") {
				$departments = $oes->getData("Department", "*", "");
			} else {
				$departments = $oes->getData("Department", "*", "CollegeID = '$collegeID' ORDER BY Name");
			}
			foreach($departments as $department) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($department["ID"] == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$department["ID"].'"'.$selected.'>'.$department["Code"].'</option>';
			}
		}
	} elseif($action == "getsubject") {
		if(isset($_POST['courseID'])) {
			$courseID = $_POST['courseID'];
			if(isset($_POST['nooption']))
				echo '<option value="null">No subjects</option>';
			if(isset($_POST['alloption']))
				echo '<option value="all">All subjects</option>';
			if($courseID == "all") {
				$subjects = $oes->getData("Subject", "*", "");
			} else {
				if(isset($_POST['except']))
					$subjects = $oes->getdata("Subject", "*", "ID NOT IN (SELECT SubjectID FROM Curriculum WHERE CourseID = '$courseID')");
				else
					$subjects = $oes->getData("Curriculum INNER JOIN Subject", "*", "SubjectID = Subject.ID AND CourseID = '$courseID' ORDER BY Name");
			}
			foreach($subjects as $subject) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($subject["ID"] == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$subject["ID"].'"'.$selected.'>'.$subject["Code"].' - '.$subject["Name"].'</option>';
			}
		}
	} elseif($action == "getcourseyear") {
		if(isset($_POST['courseID'])) {
			$courseID = $_POST['courseID'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All years</option>';
			$years = $oes->getCourseYears($courseID);
			for($i = 1; $i <= $years; $i++) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($i == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			}
		}
	} elseif($action == "getbuilding") {
		if(isset($_POST['buildingID'])) {
			$buildingID = $_POST['buildingID'];
			if(isset($_POST['alloption']))
				echo '<option value="all">All years</option>';
			$buildings = $oes->getData("Building", "*", "");
			foreach($buildings as $building) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($i == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$building["ID"].'"'.$selected.'>'.$building["Name"].'</option>';
			}
			for($i = 1; $i <= $years; $i++) {
				$selected = "";
				if(isset($_POST['equal'])) {
					$equal = $_POST['equal'];
					if($i == $equal) 
						$selected = " selected";
				}
				echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			}
		}
	} elseif($action == "listcollege") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addcollege');" class="float_button ic_plus_white icon_medium pos_top_right"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">College</td>
			</tr>
		<?php
		$tableData = $oes->getData("College", "*", "");
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editcollege', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletecollege', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData();
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "college"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
<?php
	} elseif($action == "listcurriculum") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addcurriculum');" class="float_button ic_plus_white icon_medium pos_top_right"></a>
		<table class="list">
		<?php
		if(isset($_POST['course'])) {
			if($_POST['course'] != "") {
				$course = $_POST['course'];
			}
		}
		$yearcourse = $oes->getSingleData("Course", "YearCourse", "ID = '$course'");
		$yeartext = array("1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year");
		$termtext = array("1st Semester", "2nd Semester", "3rd Semester", "Summer Term");
		$chkAll = true;
		for($year = 1; $year<= $yearcourse; $year++) {
			for($term = 1; $term <= 4; $term++) {
				$filter = "";
				if($course != "")
					$filter .= " AND CourseID = '$course' ";
		?>
			<tr class="title">
				<td width="1px">
					<?php 
					if($chkAll) {
						$chkAll = false;
					?>
					<label id="chkAll"><input type="checkbox"><span></span></label>
					<?php
					}
					?>
				</td>
				<td colspan="2"><?php echo $yeartext[$year-1].' - '.$termtext[$term-1]; ?></td>
			</tr>
				<?php
				$filter .= " AND Year = '$year' AND Term = '$term' ";
				$additional = "1=1 $filter";
				$tableData = $oes->getData("Curriculum", "*", $additional);
				if(!empty($tableData)) {
					foreach($tableData as $data) {
					?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["SubjectID"].' - '.$oes->getSingleData("Subject", "Name", "ID = '".$data["SubjectID"]."'"); ?></span>
					<span><?php echo $u = $oes->getSingleData("Subject", "Units", "ID = '".$data["SubjectID"]."'"); if($u != 1) echo ' units'; else echo ' unit'; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editcurriculum', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletecurriculum', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
					<?php
					}
				} else {
				?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					Not set.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
				}
			?>
			<?php
			}
		}
		?>
		</table>
		
	</div>
	<?php
	scriptCheckedData();
	?>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "curriculum"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
<?php
	} elseif($action == "listbuilding") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addbuilding');" class="float_button ic_plus_white icon_medium pos_top_right"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Building</td>
			</tr>
		<?php
		$tableData = $oes->getData("Building", "*", "");
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editbuilding', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletebuilding', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData();
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "building"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
<?php
	} elseif($action == "liststudent") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addstudent');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="3">Student</td>
			</tr>
			<?php
			$p = 1;
			if(isset($_POST['p']))
				$p = $_POST['p'];
			if(isset($_POST['pp'])) {
				if($_POST['pp'] == "All")
					$rowPerPage = 0;
				else
					$rowPerPage = $_POST['pp'];
			}
			$startFrom = ($p-1) * $rowPerPage;
			$filter = "";
			if(isset($_POST['search'])) {
				if($_POST['search'] != "") {
					$search = mysql_escape_string($_POST['search']);
					$filter .= " AND (CONCAT(Student.FirstName, ' ', Student.MiddleName, ' ', Student.LastName) LIKE '%$search%' OR Account.ID LIKE '%$search%') ";
				}
			}
			if(isset($_POST['college'])) {
				if($_POST['college'] != "all") {
					$college = $_POST['college'];
					$filter .= " AND Student.Course IN (SELECT ID FROM Course WHERE CollegeID = '$college') ";
				}
			}
			if(isset($_POST['course'])) {
				if($_POST['course'] == "null") {
					$filter .= " AND Student.Course IS NULL ";
				} elseif($_POST['course'] != "all") {
					$course = $_POST['course'];
					$filter .= " AND Student.Course = '$course' ";
				}
			}
			$additional = "Account.Type = 'Student' AND Account.ID = Student.ID $filter LIMIT $startFrom, $rowPerPage";
			if($rowPerPage == 0) 
				$additional = "Account.Type = 'Student' $filter";
			$tableData = $oes->getData("Account INNER JOIN Student", "*", $additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td width="1px">
					<span class="flat_icon_36 circle_icon trans_icon" style="background-image: url(<?php echo $oes->getProfilePicture($data["ID"]); ?>)"></span>
				</td>
				<td class="primary">
					<span><?php echo $oes->getNameFormat("l, f M.", $data["ID"]); ?></span>
					<span><?php echo $data["ID"]; ?></span>
				</td>
				<td width="1px">
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
				<script>
				$(document).ready(function() {
					$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
						showBottomSheet('editstudent', '<?php echo $data["ID"]; ?>');
					});
					$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
						showDialogBox('deletestudent', '<?php echo $data["ID"]; ?>');
					});
				});
				</script>
				<?php
				}
				scriptCheckedData();
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "student"},
		success: function(html) {
			$("#data-action-bar #actions").html(html);
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Account INNER JOIN Student WHERE Account.Type = 'Student' AND Account.ID = Student.ID", $filter, $rowPerPage, $p, "refreshListStudent();");
	} elseif($action == "listfaculty") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addfaculty');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="3">Faculty</td>
			</tr>
			<?php
			$p = 1;
			if(isset($_POST['p']))
				$p = $_POST['p'];
			if(isset($_POST['pp'])) {
				if($_POST['pp'] == "All")
					$rowPerPage = 0;
				else
					$rowPerPage = $_POST['pp'];
			}
			$startFrom = ($p-1) * $rowPerPage;
			$filter = "";
			if(isset($_POST['search'])) {
				if($_POST['search'] != "") {
					$search = mysql_escape_string($_POST['search']);
					$filter .= " AND (CONCAT(FirstName, ' ', MiddleName, ' ', LastName) LIKE '%$search%' OR Account.ID LIKE '%$search%') ";
				}
			}
			if(isset($_POST['college'])) {
				if($_POST['college'] != "all") {
					$college = $_POST['college'];
					$filter .= " AND Department IN (SELECT ID FROM Department WHERE CollegeID = '$college') ";
				}
			}
			if(isset($_POST['department'])) {
				if($_POST['department'] == "null") {
					$filter .= " AND Department IS NULL ";
				} elseif($_POST['department'] != "all") {
					$department = $_POST['department'];
					$filter .= " AND Department = '$department' ";
				}
			}
			$additional = "Type = 'Faculty' AND Account.ID = Faculty.ID $filter LIMIT $startFrom, $rowPerPage";
			if($rowPerPage == 0) 
				$additional = "Type = 'Faculty' AND Account.ID = Faculty.ID $filter";
			$tableData = $oes->getData("Account INNER JOIN Faculty", "*", $additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td width="1px">
					<span class="flat_icon_36 circle_icon trans_icon" style="background-image: url(<?php echo $oes->getProfilePicture($data["ID"]); ?>)"></span>
				</td>
				<td class="primary">
					<span><?php echo $oes->getNameFormat("l, f M.", $data["ID"]); ?></span>
					<span><?php echo $data["ID"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editfaculty', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletefaculty', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
				<?php
				}
				scriptCheckedData();
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "faculty"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Account INNER JOIN Faculty WHERE Type = 'Faculty'", $filter, $rowPerPage, $p, "refreshListFaculty();");
	} elseif($action == "listcourse") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addcourse');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Course</td>
			</tr>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (Name LIKE '%$search%' OR Code LIKE '%$search%') ";
			}
		}
		if(isset($_POST['college'])) {
			if($_POST['college'] != "all") {
				$college = $_POST['college'];
				$filter .= " AND CollegeID = '$college' ";
			}
		}
		$additional = "1=1 $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "1=1 $filter";
		$tableData = $oes->getData("Course", "*", $additional);
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editcourse', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletecourse', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData();
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "course"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Course WHERE 1=1", $filter, $rowPerPage, $p, "refreshListCourse();");
	} elseif($action == "listroom") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addroom');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Room</td>
			</tr>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND Name LIKE '%$search%' ";
			}
		}
		if(isset($_POST['building'])) {
			if($_POST['building'] != "all") {
				$building = $_POST['building'];
				$filter .= " AND BuildingID = '$building' ";
			}
		}
		$additional = "1=1 $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "1=1 $filter";
		$tableData = $oes->getData("Room", "*", $additional);
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $oes->getSingleData("Building", "Name", "ID = '".$data["BuildingID"]."'"); ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editroom', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deleteroom', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData();
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "room"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Room WHERE 1=1", $filter, $rowPerPage, $p, "refreshListRoom();");
	} elseif($action == "listdepartment") {
?>
	<div class="card">
		<a onclick="showBottomSheet('adddepartment');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Department</td>
			</tr>
		<?php
		$p = 1;
		if(isset($_POST['p']))
			$p = $_POST['p'];
		if(isset($_POST['pp'])) {
			if($_POST['pp'] == "All")
				$rowPerPage = 0;
			else
				$rowPerPage = $_POST['pp'];
		}
		$startFrom = ($p-1) * $rowPerPage;
		$filter = "";
		if(isset($_POST['search'])) {
			if($_POST['search'] != "") {
				$search = mysql_escape_string($_POST['search']);
				$filter .= " AND (Name LIKE '%$search%' OR Code LIKE '%$search%') ";
			}
		}
		if(isset($_POST['college'])) {
			if($_POST['college'] != "all") {
				$college = $_POST['college'];
				$filter .= " AND CollegeID = '$college' ";
			}
		}
		$additional = "1=1 $filter LIMIT $startFrom, $rowPerPage";
		if($rowPerPage == 0) 
			$additional = "1=1 $filter";
		$tableData = $oes->getData("Department", "*", $additional);
		if(!empty($tableData)) {
			foreach($tableData as $data) {
			?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td>
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editdepartment', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletedepartment', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
			<?php
			}
			scriptCheckedData();
		} else {
		?>
			<tr>
				<td></td>
				<td colspan="3" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
		<?php
		}
		?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "department"},
		success: function(html) {
			$("#data-action-bar #actions").html(html)
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Department WHERE 1=1", $filter, $rowPerPage, $p, "refreshListDepartment();");
	} elseif($action == "listsubject") {
?>
	<div class="card">
		<a onclick="showBottomSheet('addsubject');" class="float_button pos_top_right ic_plus_white icon_medium"></a>
		<table class="list">
			<tr class="title">
				<td width="1px">
					<label id="chkAll"><input type="checkbox"><span></span></label>
				</td>
				<td colspan="2">Subject</td>
			</tr>
			<?php
			$p = 1;
			if(isset($_POST['p']))
				$p = $_POST['p'];
			if(isset($_POST['pp'])) {
				if($_POST['pp'] == "All")
					$rowPerPage = 0;
				else
					$rowPerPage = $_POST['pp'];
			}
			$startFrom = ($p-1) * $rowPerPage;
			$filter = "";
			if(isset($_POST['search'])) {
				if($_POST['search'] != "") {
					$search = mysql_escape_string($_POST['search']);
					$filter .= " AND (Name LIKE '%$search%' OR Code LIKE '%$search%') ";
				}
			}
			$additional = "$filter LIMIT $startFrom, $rowPerPage";
			if($rowPerPage == 0) 
				$additional = "$filter";
			$tableData = $oes->getData("Subject", "*", "1=1 ".$additional);
			if(!empty($tableData)) {
				foreach($tableData as $data) {
				?>
			<tr>
				<td>
					<label class="checkData" id="chk_<?php echo $data["ID"]; ?>"><input type="checkbox" value="<?php echo $data["ID"]; ?>"><span></span></label>
				</td>
				<td class="primary">
					<span><?php echo $data["Name"]; ?></span>
					<span><?php echo $data["Code"]; ?></span>
				</td>
				<td width="1px">
					<ul class="button-container">
						<li>
							<a id="btnEdit_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_pencil showhover"></a>
							<a id="btnDelete_<?php echo $data["ID"]; ?>" class="flat_icon_20 ic_delete showhover"></a>
						</li>
					</ul>
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#btnEdit_<?php echo $data["ID"]; ?>").click(function() {
					showBottomSheet('editsubject', '<?php echo $data["ID"]; ?>');
				});
				$("#btnDelete_<?php echo $data["ID"]; ?>").click(function() {
					showDialogBox('deletesubject', '<?php echo $data["ID"]; ?>');
				});
			});
			</script>
				<?php
				}
				scriptCheckedData();
			} else {
			?>
			<tr>
				<td></td>
				<td colspan="2" align="center">
					No result found.
				</td>
			</tr>
			<script>
			$(document).ready(function() {
				$("#chkAll").css({"visibility": "hidden"});
			});
			</script>
			<?php
			}
			?>
		</table>
	</div>
	<script>
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdataaction",
		data: {module: "subject"},
		success: function(html) {
			$("#data-action-bar #actions").html(html);
		}
	})
	</script>
		<?php
		showPagination("SELECT * FROM Subject WHERE 1=1", $filter, $rowPerPage, $p, "refreshListSubject();");
	} elseif($action == "addcurriculum") {
		if(isset($_POST['courseID'], $_POST['subject'], $_POST['courseyear'], $_POST['term'])) {
			$courseID = mysql_escape_string($_POST['courseID']);
			$subject = mysql_escape_string($_POST['subject']);
			$courseyear = mysql_escape_string($_POST['courseyear']);
			$term = mysql_escape_string($_POST['term']);
			if($courseID != "" && $subject != "" && $courseyear != "" && $term != "") {
				$q1 = mysql_query("INSERT INTO Curriculum (CourseID, SubjectID, Year, Term) VALUES ('$courseID', '$subject', '$courseyear', '$term')");
				if($q1) 
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editcurriculum") {
		if(isset($_POST['id'], $_POST['subject'], $_POST['courseyear'], $_POST['term'])) {
			$id = mysql_escape_string($_POST['id']);
			$subject = mysql_escape_string($_POST['subject']);
			$courseyear = mysql_escape_string($_POST['courseyear']);
			$term = mysql_escape_string($_POST['term']);
			if($id != "" && $subject != "" && $courseyear != "" && $term != "") {
				$q1 = mysql_query("UPDATE Curriculum SET SubjectID = '$subject', Year = '$courseyear', Term = '$term' WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletecurriculum") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Curriculum WHERE ID = '$id'");
			if($q1)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletecurriculum_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Curriculum WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addcollege") {
		if(isset($_POST['name'], $_POST['code'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO College (Name, Code) VALUES ('$name', '$code')");
				if($q1) 
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editcollege") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE College SET Name = '$name', Code = '$code' WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletecollege") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM College WHERE ID = '$id'");
			if($q1)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletecollege_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM College WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addroom") {
		if(isset($_POST['name'], $_POST['building'], $_POST['type'], $_POST['from'], $_POST['to'])) {
			$name = mysql_escape_string($_POST['name']);
			$building = mysql_escape_string($_POST['building']);
			$type = mysql_escape_string($_POST['type']);
			$from = mysql_escape_string($_POST['from']);
			$to = mysql_escape_string($_POST['to']);
			if($type == "single") {
				if($name != "" && $building != "") {
					$exists = $oes->isExists("Room", array("BuildingID", "Name"), array($building, $name));
					if(!$exists) {
						$q1 = mysql_query("INSERT INTO Room (BuildingID, Name) VALUES ('$building', '$name')");
						if($q1) 
							showSnackbar('add_success');
						else
							showSnackbar('add_error');
					} else
						showSnackbar('add_error');
				} else {
					showSnackbar('add_error');
				}
			} elseif($type == "multiple") {
				if($from != "" && $to != "" && $building != "") {
					if($from <= $to && is_numeric($from) && is_numeric($to)) {
						$continue = true;
						for($i = $from; $i <= $to; $i++) {
							$exists = $oes->isExists("Room", array("BuildingID", "Name"), array($building, $i));
							if($exists) {
								$continue = false;
								break;
							}
						}
						if($continue) {
							for($i = $from; $i <= $to; $i++) {
								$q1 = mysql_query("INSERT INTO Room (BuildingID, Name) VALUES ('$building', '$i')");
								if($q1) 
									showSnackbar('add_success');
								else
									showSnackbar('add_error');
							}
						} else
							showSnackbar('add_error');
					} else
						showSnackbar('add_error');
				} else
					showSnackbar('add_error');
			} else
				showSnackbar('add_error');
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editroom") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$building = mysql_escape_string($_POST['building']);
			if($name != "" && $building != "") {
				$exists = $oes->isExists("Room", array("BuildingID", "Name"), array($building, $name));
				if(!$exists) {
					$q1 = mysql_query("UPDATE Room SET BuildingID = '$building', Name = '$name' WHERE ID = '$id'");
					if($q1) 
						showSnackbar('add_success');
					else
						showSnackbar('add_error');
				} else
					showSnackbar('add_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deleteroom") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Room WHERE ID = '$id'");
			if($q1)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deleteroom_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Room WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addbuilding") {
		if(isset($_POST['name'], $_POST['code'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Building (Name, Code) VALUES ('$name', '$code')");
				if($q1) 
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editbuilding") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Building SET Name = '$name', Code = '$code' WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletebuilding") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Building WHERE ID = '$id'");
			if($q1)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletebuilding_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Building WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addcourse") {
		if(isset($_POST['name'], $_POST['code'], $_POST['college'], $_POST['yearcourse'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			$yearcourse = $_POST['yearcourse'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Course (Name, Code, CollegeID, YearCourse) VALUES ('$name', '$code', '$college', '$yearcourse')");
				if($q1) 
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editcourse") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			$yearcourse = $_POST['yearcourse'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Course SET Name = '$name', Code = '$code', CollegeID = '$college', YearCourse = '$yearcourse' WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletecourse") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Course WHERE ID = '$id'");
			$q2 = mysql_query("UPDATE Student SET Course = NULL WHERE Course = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletecourse_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Course WHERE ID = '$data'");
				$q2 = mysql_query("UPDATE Student SET Course = NULL WHERE Course = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "adddepartment") {
		if(isset($_POST['name'], $_POST['code'], $_POST['college'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Department (Name, Code, CollegeID) VALUES ('$name', '$code', '$college')");
				if($q1) 
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editdepartment") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$college = $_POST['college'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Department SET Name = '$name', Code = '$code', CollegeID = '$college' WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletedepartment") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Department WHERE ID = '$id'");
			$q2 = mysql_query("UPDATE Faculty SET Course = NULL WHERE Department = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletedepartment_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Department WHERE ID = '$data'");
				$q2 = mysql_query("UPDATE Faculty SET Department = NULL WHERE Department = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addsubject") {
		if(isset($_POST['name'], $_POST['code'], $_POST['units'])) {
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$units = $_POST['units'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("INSERT INTO Subject (Name, Code, Units) VALUES ('$name', '$code', '$units')");
				if($q1) 
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editsubject") {
		if(isset($_POST['name'])) {
			$id = $_POST['id'];
			$name = mysql_escape_string($_POST['name']);
			$code = mysql_escape_string($_POST['code']);
			$units = $_POST['units'];
			if($name != "" && $code != "") {
				$q1 = mysql_query("UPDATE Subject SET Name = '$name', Code = '$code', Units = '$units' WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletesubject") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Subject WHERE ID = '$id'");
			if($q1)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletesubject_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Subject WHERE ID = '$data'");
				if(!$q1)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addstudent") {
		if(isset($_POST['fname'])) {
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			$course = $_POST['course'];
			$year = $_POST['year'];
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				$id = $oes->GenerateAccountID();
				$username = $oes->GenerateUsername($id, $fname, $mname, $lname);
				$q1 = mysql_query("INSERT INTO Account (ID, Username, Type) VALUES ('$id', '$username', 'Student')");
				if($course != "null")
					$q2 = mysql_query("INSERT INTO Student (ID, FirstName, MiddleName, LastName, BirthDate, Gender, Course, Year) VALUES ('$id', '$fname', '$mname', '$lname', '$bday', '$gender', '$course', '$year')");
				else
					$q2 = mysql_query("INSERT INTO Student (ID, FirstName, MiddleName, LastName, BirthDate, Gender, Course, Year) VALUES ('$id', '$fname', '$mname', '$lname', '$bday', '$gender', NULL, NULL)");
				if($q1 && $q2)
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editstudent") {
		if(isset($_POST['fname'])) {
			$id = $_POST['id'];
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			$course = $_POST['course'];
			$year = $_POST['year'];
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				if($course != "null")
					$q1 = mysql_query("UPDATE Student SET FirstName = '$fname', MiddleName = '$mname', LastName =  '$lname', BirthDate = '$bday', Gender = '$gender', Course = '$course', Year = '$year' WHERE ID = '$id'");
				else
					$q1 = mysql_query("UPDATE Student SET FirstName = '$fname', MiddleName = '$mname', LastName =  '$lname', BirthDate = '$bday', Gender = '$gender', Course = NULL, Year = NULL WHERE ID = '$id'");
				if($q1)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletestudent") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Account WHERE ID = '$id'");
			$q2 = mysql_query("DELETE FROM Student WHERE ID = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletestudent_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Account WHERE ID = '$data'");
				$q2 = mysql_query("DELETE FROM Student WHERE ID = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "addfaculty") {
		if(isset($_POST['fname'])) {
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			$department = $_POST['department'];
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				$id = $oes->GenerateAccountID();
				$username = $oes->GenerateUsername($id, $fname, $mname, $lname);
				$q1 = mysql_query("INSERT INTO Account (ID, Username, Type) VALUES ('$id', '$username', 'Faculty')");
				if($department != "null")
					$q2 = mysql_query("INSERT INTO Faculty (ID, FirstName, MiddleName, LastName, BirthDate, Gender, Department) VALUES ('$id', '$fname', '$mname', '$lname', '$bday', '$gender', '$department')");
				else
					$q2 = mysql_query("INSERT INTO Faculty (ID, FirstName, MiddleName, LastName, BirthDate, Gender, Department) VALUES ('$id', '$fname', '$mname', '$lname', '$bday', '$gender', NULL)");
				if($q1 && $q2)
					showSnackbar('add_success');
				else
					showSnackbar('add_error');
			} else {
				showSnackbar('add_error');
			}
		} else {
			showSnackbar('add_error');
		}
	} elseif($action == "editfaculty") {
		if(isset($_POST['fname'])) {
			$id = $_POST['id'];
			$fname = mysql_escape_string($_POST['fname']);
			$mname = mysql_escape_string($_POST['mname']);
			$lname = mysql_escape_string($_POST['lname']);
			$bday = $_POST['bday'];
			$gender = $_POST['gender'];
			$department = $_POST['department'];
			if($fname != "" && $mname != "" && $lname != "" && $bday != "") {
				$q1 = mysql_query("UPDATE Account SET WHERE ID = '$id'");
				if($department != "null")
					$q2 = mysql_query("UPDATE Faculty SET FirstName = '$fname', MiddleName = '$mname', LastName =  '$lname', BirthDate = '$bday', Gender = '$gender', Department = '$department' WHERE ID = '$id'");
				else
					$q2 = mysql_query("UPDATE Faculty SET FirstName = '$fname', MiddleName = '$mname', LastName =  '$lname', BirthDate = '$bday', Gender = '$gender', Department = NULL WHERE ID = '$id'");
				if($q1 && $q2)
					showSnackbar('edit_success');
				else
					showSnackbar('edit_error');
			} else {
				showSnackbar('edit_error');
			}
		} else {
			showSnackbar('edit_error');
		}
	} elseif($action == "deletefaculty") {
		if(isset($_POST['id'])) {
			$id = $_POST['id'];
			$q1 = mysql_query("DELETE FROM Account WHERE ID = '$id'");
			$q2 = mysql_query("DELETE FROM Faculty WHERE ID = '$id'");
			if($q1 && $q2)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "deletefaculty_data") {
		if(isset($_POST['checkedData'])) {
			$checkedData = $_POST['checkedData'];
			$success = true;
			foreach($checkedData as $data) {
				$q1 = mysql_query("DELETE FROM Account WHERE ID = '$data'");
				$q2 = mysql_query("DELETE FROM Faculty WHERE ID = '$data'");
				if(!$q1 || !$q2)
					$success = false;
			}
			if($success)
				showSnackbar('delete_success');
			else
				showSnackbar('delete_error');
		} else {
			showSnackbar('delete_error');
		}
	} elseif($action == "getdataaction") {
		if(isset($_POST['module'])) {
			$m = $_POST['module'];
			if($m == "student") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletestudent_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "faculty") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletefaculty_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "college") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletecollege_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "building") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletebuilding_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "course") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletecourse_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "department") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletedepartment_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "subject") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletesubject_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "room") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deleteroom_data", $checkedData);
				});
				</script>
			<?php
			} elseif($m == "curriculum") {
			?>
				<li><a id="btnDeleteSelected"><span class="flat_icon ic_delete_black trans_icon"></span>Delete</a></li>
				<script>
				$("#data-action-bar #btnDeleteSelected").click(function() {
					showDialogBox("deletecurriculum_data", $checkedData);
				});
				</script>
			<?php
			}
		}
	} else {
		header("Location: index.php");
	}
} else {
	header("Location: index.php");
}
?>