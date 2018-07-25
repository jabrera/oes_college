<div class="content">
	<h3>Add Department</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>Department Name</label>
				<input type="text" name="name" placeholder="Department Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Department Code</label>
				<input type="text" name="code" placeholder="Department Code">
			</td>
		</tr>
		<tr>
			<td>
				<label>College</label>
				<select name="college">
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
		url: "process.php?action=getcollege",
		data: {collegeID: 'all'},
		success: function(html) {
			$("#BottomSheetForm select[name='college']").html(html);
			$("#btnAdd").show();
		}
	});
	$("#btnAdd").click(function() {
		$name = $("#BottomSheetForm input[name='name']").val();
		$code = $("#BottomSheetForm input[name='code']").val();
		$college = $("#BottomSheetForm [name='college']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=adddepartment",
			data: {name: $name, code: $code, college: $college},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListDepartment();
			}
		});
	});
})
</script>