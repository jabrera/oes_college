<div class="content">
	<h3>Add Faculty</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>Full Name</label>
				<input type="text" name="fname" placeholder="First Name">
				<input type="text" name="mname" placeholder="Middle Name">
				<input type="text" name="lname" placeholder="Last Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Birth date</label>
				<input type="date" name="bday" placeholder="Birth date">
			</td>
		</tr>
		<tr>
			<td>
				<label>Gender</label>
				<select name="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
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
		<li><a id="btnAdd" target="_blank" class="raised_button">Add</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnAdd").hide();
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getdepartment",
		data: {collegeID: 'all', nooption: 1},
		success: function(html) {
			$("#BottomSheetForm select[name='department']").html(html);
			$("#btnAdd").show();
		}
	});
	$("#btnAdd").click(function() {
		$fname = $("#BottomSheetForm [name='fname']").val();
		$mname = $("#BottomSheetForm [name='mname']").val();
		$lname = $("#BottomSheetForm [name='lname']").val();
		$bday = $("#BottomSheetForm [name='bday']").val();
		$gender = $("#BottomSheetForm [name='gender']").val();
		$department = $("#BottomSheetForm [name='department']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addfaculty",
			data: {fname: $fname, mname: $mname, lname: $lname, bday: $bday, gender: $gender, department: $department},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListFaculty();
			}
		})
	});
});
</script>