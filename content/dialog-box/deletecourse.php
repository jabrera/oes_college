<span class="title">Message</span>
<p>
	Are you sure you want to delete this course?
	<ul class="list">
		<li>
			<div class="primary"><span>Course Name</span><span><?php echo $oes->getSingleData("Course", "Name", "ID = '$db_id'"); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Course Code</span><span><?php echo $oes->getSingleData("Course", "Code", "ID = '$db_id'"); ?></span></div>
		</li>
	</ul>
</p>
<ul class="button-container right">
	<li><a onclick="showElement('none')" class="flat_button">No</a></li>
	<li><a id="btnDelete" class="flat_button">Yes</a></li>
</ul>
<script>
$(document).ready(function() {
	$("#btnDelete").click(function() {
		$.ajax({
			type: "post",
			cache: false,
			url: "process.php?action=deletecourse",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListCourse();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>