<span class="title">Message</span>
<p>
	Are you sure you want to delete this student?
	<ul class="list">
		<li>
			<div class="primary"><span>Student No.</span><span><?php echo $db_id; ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Full Name</span><span><?php echo $oes->getNameFormat("l, f M.", $db_id); ?></span></div>
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
			url: "process.php?action=deletestudent",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListStudent();
				$("#snackbar .wrapper").html(html);
			}
		});
	});
});
</script>