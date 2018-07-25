<div class="content">
	<h3>Add Course</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>Course Name</label>
				<input type="text" name="name" placeholder="Course Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Course Code</label>
				<input type="text" name="code" placeholder="Course Code">
			</td>
		</tr>
		<tr>
			<td>
				<label>College</label>
				<select name="college">
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Year Course</label>
				<select name="yearcourse">
					<?php
					for($i = 1; $i <= 12; $i++) 
						echo '<option value="'.$i.'">'.$i.'</option>';
					?>
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
		$yearcourse = $("#BottomSheetForm [name='yearcourse']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addcourse",
			data: {name: $name, code: $code, college: $college, yearcourse: $yearcourse},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListCourse();
			}
		});
	});
})
</script>