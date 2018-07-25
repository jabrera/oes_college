<?php
$studentData = $oes->getRow("Account INNER JOIN Student", "*", "Account.ID = '$bs_id' AND Account.ID = Student.ID");
?>
<div class="cover"<?php if(file_exists("images/users/$bs_id.jpg")) echo ' style="background-image: url(images/users/$bs_id.jpg);"'; ?>>
	<div class="shadow"></div>
	<div class="title"><?php echo $oes->getNameFormat("l, f M.", $bs_id); ?></div>
</div>
<div class="content">
	<h3>Edit Student</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>Full Name</label>
				<input type="text" name="fname" value="<?php echo $studentData["FirstName"]; ?>" placeholder="First Name">
				<input type="text" name="mname" value="<?php echo $studentData["MiddleName"]; ?>" placeholder="Middle Name">
				<input type="text" name="lname" value="<?php echo $studentData["LastName"]; ?>" placeholder="Last Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Birth date</label>
				<input type="date" name="bday" placeholder="Birth date" value="<?php echo $studentData["BirthDate"]; ?>">
			</td>
		</tr>
		<tr>	
			<td>
				<label>Gender</label>
				<select name="gender">
					<?php
					$genders = array("Male", "Female");
					$u_gender = $studentData["Gender"];
					foreach($genders as $gender) {
						$selected = "";
						if($u_gender == $gender) 
							$selected = " selected";
						echo '<option value="'.$gender.'"'.$selected.'>'.$gender.'</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Course/Year</label>
				<select name="course">
				</select>
				<select name="year">
				</select>
			</td>
		</tr>
	</table>
	<ul class="button-container right">
		<li><a onclick="showElement('none');" target="_blank" class="raised_button">Cancel</a></li>
		<li><a id="btnUpdate" target="_blank" class="raised_button">Update</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnUpdate").hide();
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getcourse",
		data: {collegeID: 'all', equal: '<?php echo $studentData["Course"]; ?>'},
		success: function(html) {
			$("#BottomSheetForm select[name='course']").html(html);
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getcourseyear",
				data: {courseID: $("#BottomSheetForm select[name='course']").val(), equal: '<?php echo $studentData["Year"]; ?>'},
				success: function(html) {
					$("#BottomSheetForm select[name='year']").html(html);
					$("#btnUpdate").show();
				}
			});
		}
	});
	$("#BottomSheetForm select[name='course']").change(function() {
		$("#btnUpdate").hide();
		$val = $(this).val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=getcourseyear",
			data: {courseID: $val},
			success: function(html) {
				$("#BottomSheetForm select[name='year']").html(html);
				$("#btnUpdate").show();
			}
		});
	});
	$("#btnUpdate").click(function() {
		$fname = $("#BottomSheetForm [name='fname']").val();
		$mname = $("#BottomSheetForm [name='mname']").val();
		$lname = $("#BottomSheetForm [name='lname']").val();
		$bday = $("#BottomSheetForm [name='bday']").val();
		$gender = $("#BottomSheetForm [name='gender']").val();
		$course = $("#BottomSheetForm [name='course']").val();
		$year = $("#BottomSheetForm [name='year']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editstudent",
			data: {id: <?php echo $bs_id; ?>, fname: $fname, mname: $mname, lname: $lname, bday: $bday, gender: $gender, course: $course, year: $year},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListStudent();
			}
		})
	});
});
</script>