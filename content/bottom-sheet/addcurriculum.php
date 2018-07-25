<div class="content" id="BottomSheetForm">
	<h3>Add Subject to Curriculum</h3>
	<table class="form-container">
		<tr>
			<td>
				<label>Subject</label>
				<select name="subject"></select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Year</label>
				<select name="courseyear"></select>
			</td>
		</tr>
		<tr>
			<td>
				<label>Term</label>
				<select name="term"></select>
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
	$courseVal = $("#frmSearch select[name='course']").val();
	$("#btnAdd").hide();
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getsubject",
		data: {courseID: $courseVal, except: 1},
		success: function(html) {
			$("#BottomSheetForm select[name='subject']").html(html);
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getterm",
				data: {term: "all"},
				success: function(html) {
					$("#BottomSheetForm select[name='term']").html(html);
					$.ajax({
						type: "post",
						cache: true,
						url: "process.php?action=getcourseyear",
						data: {courseID: $courseVal},
						success: function(html) {
							$("#BottomSheetForm select[name='courseyear']").html(html);
							$("#btnAdd").show();
						}
					});
				}
			});
		}
	});
	$("#btnAdd").click(function() {
		$subject = $("#BottomSheetForm select[name='subject']").val();
		$courseyear = $("#BottomSheetForm select[name='courseyear']").val();
		$term = $("#BottomSheetForm select[name='term']").val();
		$courseID = $("#frmSearch select[name='course']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=addcurriculum",
			data: {courseID: $courseID, subject: $subject, courseyear: $courseyear, term: $term},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListCurriculum();
			}
		});
	});
})
</script>