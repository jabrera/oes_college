<?php
$curriculumData = $oes->getRow("Curriculum", "*", "ID = '$bs_id'");
?>
<div class="content">
	<h3>Edit Curriculum</h3>
	<table class="form-container" id="BottomSheetForm">
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
		<li><a id="btnUpdate" target="_blank" class="raised_button">Update</a></li>
	</ul>
</div>
<script>
$(document).ready(function() {
	$("#btnUpdate").hide();
	$.ajax({
		type: "post",
		cache: true,
		url: "process.php?action=getsubject",
		data: {courseID: "all", equal: '<?php echo $curriculumData["SubjectID"]; ?>'},
		success: function(html) {
			$("#BottomSheetForm select[name='subject']").html(html);
			$.ajax({
				type: "post",
				cache: true,
				url: "process.php?action=getcourseyear",
				data: {courseID: '<?php echo $curriculumData["CourseID"]; ?>', equal: '<?php echo $curriculumData["Year"]; ?>'},
				success: function(html) {
					$("#BottomSheetForm select[name='courseyear']").html(html);
					$.ajax({
						type: "post",
						cache: true,
						url: "process.php?action=getterm",
						data: {term: '<?php echo $curriculumData["Term"]; ?>'},
						success: function(html) {
							$("#BottomSheetForm select[name='term']").html(html);
							$("#btnUpdate").show();
						}
					});
				}
			});
		}
	});
	$("#btnUpdate").click(function() {
		$subject = $("#BottomSheetForm select[name='subject']").val();
		$courseyear = $("#BottomSheetForm select[name='courseyear']").val();
		$term = $("#BottomSheetForm select[name='term']").val();
		$.ajax({
			type: "post",
			cache: true,
			url: "process.php?action=editcurriculum",
			data: {id: <?php echo $bs_id; ?>, subject: $subject, courseyear: $courseyear, term: $term},
			success: function(html) {
				showElement('none');
				$("#snackbar .wrapper").html(html);
				refreshListCurriculum();
			}
		})
	});
});
</script>