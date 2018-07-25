<div class="content">
	<h3>Add Building</h3>
	<table class="form-container" id="BottomSheetForm">
		<tr>
			<td>
				<label>Building Name</label>
				<input type="text" name="name" placeholder="Building Name">
			</td>
		</tr>
		<tr>
			<td>
				<label>Building Code</label>
				<input type="text" name="code" placeholder="Building Code">
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
			url: "process.php?action=addbuilding",
			data: {name: $name, code: $code},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListBuilding();
			}
		});
	});
})
</script>