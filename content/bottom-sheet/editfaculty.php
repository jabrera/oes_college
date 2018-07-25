<?php
$facultyData = $oes->getRow("Account INNER JOIN Faculty", "*", "Account.ID = '$bs_id' AND Account.ID = Faculty.ID");
?>
<div class="cover"<?php if(file_exists("images/users/$bs_id.jpg")) echo ' style="background-image: url(images/users/$bs_id.jpg);"'; ?>>
	<div class="shadow"></div>
	<div class="title"><?php echo $oes->getNameFormat("l, f M.", $bs_id); ?></div>
</div>
<div class="content">
	<h3>Edit Faculty</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>Full Name</label>
				<input type="text" name="fname" value="<?php echo $facultyData["FirstName"]; ?>" placeholder="First Name">
				<input type="text" name="mname" value="<?php echo $facultyData["MiddleName"]; ?>" placeholder="Middle Name">
				<input type="text" name="lname" value="<?php echo $facultyData["LastName"]; ?>" placeholder="Last Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Birth date</label>
				<input type="date" name="bday" placeholder="Birth date" value="<?php echo $facultyData["BirthDate"]; ?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Gender</label>
				<select name="gender">
					<?php
					$genders = array("Male", "Female");
					$u_gender = $facultyData["Gender"];
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
				<label>Department</label>
				<select name="department">
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
		url: "process.php?action=getdepartment",
		data: {collegeID: 'all', nooption: 1, equal: '<?php echo $facultyData["Department"]; ?>'},
		success: function(html) {
			$("#BottomSheetForm select[name='department']").html(html);
			$("#btnUpdate").show();
		}
	});
	$("#btnUpdate").click(function() {
		$fname = $("#BottomSheetForm [name='fname']").val();
		$mname = $("#BottomSheetForm [name='mname']").val();
		$lname = $("#BottomSheetForm [name='lname']").val();
		$bday = $("#BottomSheetForm [name='bday']").val();
		$gender = $("#BottomSheetForm [name='gender']").val();
		$department = $("#BottomSheetForm [name='department']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editfaculty",
			data: {id: <?php echo $bs_id; ?>, fname: $fname, mname: $mname, lname: $lname, bday: $bday, gender: $gender, department: $department},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListFaculty();
			}
		})
	});
});
</script>