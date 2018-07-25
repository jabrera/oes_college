<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Student Master Data</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card">
					<h4>Search and Filter</h4>
					<hr>
					<table class="form-container" id="frmSearch">
						<tr>
							<td>
								<label>Search</label>
								<input type="text" name="search" placeholder="Search Name or Student No."<?php if(isset($_POST['search'])) echo 'value="'.$_POST['search'].'"'; ?>>
							</td>
						</tr>
						<tr>
							<td><label>Results per page</label>
							<select name="pp">
							<?php
							$options = array(25,100,250,"All");
							foreach($options as $option) {
								echo '<option value="'.$option.'">'.$option.'</option>';
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td><label>College</label>
							<select name="college" id="ddlCollege">
							<?php
							$options = $oes->getData("College", "*", "");
							array_unshift($options, array("ID" => "all", "Code" => "All colleges"));
							foreach($options as $option) {
								echo '<option value="'.$option["ID"].'">'.$option["Code"].'</option>';
							}
							?>
							</select>
							</td>
						</tr>
						<tr>
							<td><label>Course</label>
							<select name="course" id="ddlCourse">
							<?php
							$options = $oes->getData("Course", "*", "");
							array_unshift($options, array("ID" => "all", "Code" => "All courses"));
							foreach($options as $option) {
								echo '<option value="'.$option["ID"].'">'.$option["Code"].'</option>';
							}
							?>
							</select><input type="hidden" name="p" value="1"></td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">Search and Filter</a></li>
					</ul>
					<script>
					function refreshListStudent() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstStudent").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$p = $("#frmSearch input[name='p']").val();
						$search = $("#frmSearch input[name='search']").val();
						$pp = $("#frmSearch select[name='pp']").val();
						$college = $("#frmSearch select[name='college']").val();
						$course = $("#frmSearch select[name='course']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=liststudent",
							data: {p: $p, search: $search, pp: $pp, college: $college, course: $course},
							success: function(html) {
								$("#lstStudent").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListStudent();
						});
						$("#ddlCollege").change(function() {
							$collegeID = $(this).val();
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=getcourse",
								data: {collegeID: $collegeID, alloption: 1},
								success: function(html) {
									$("#ddlCourse").html(html);
									$courseID = $("#ddlCourse").val();
									$.ajax({
										type: "post",
										cache: true,
										url: "process.php?action=getcourseyear",
										data: {courseID: $courseID, alloption: 1},
										success: function(html) {
											$("#ddlYear").html(html);
											$.ajax({

											});
										}
									});
								}
							});
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstStudent">
			</div>
			<script>
			$checkedData = [];
			refreshListStudent();
			</script>
		</div>
	</div>
</div>