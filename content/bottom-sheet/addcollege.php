<div class="content">
	<h3>Add College</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>College Name</label>
				<input type="text" name="name" placeholder="College Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>College Code</label>
				<input type="text" name="code" placeholder="College Code">
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
	$("#btnAdd").click(function() {
		$name = $("#BottomSheetForm input[name='name']").val();
		$code = $("#BottomSheetForm input[name='code']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addcollege",
			data: {name: $name, code: $code},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListCollege();
			}
		});
	});
})
</script>