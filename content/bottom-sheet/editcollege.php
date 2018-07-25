<?php
$collegeData = $oes->getRow("College", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit College</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>College Name</label>
				<input type="text" name="name" value="<?php echo $collegeData["Name"]; ?>" placeholder="College Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>College Code</label>
				<input type="text" name="code" value="<?php echo $collegeData["Code"]; ?>" placeholder="College Code">
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
	$("#btnUpdate").click(function() {
		$name = $("#BottomSheetForm [name='name']").val();
		$code = $("#BottomSheetForm [name='code']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editcollege",
			data: {id: <?php echo $bs_id; ?>, name: $name, code: $code},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListCollege();
			}
		})
	});
});
</script>