<span class="title">Message</span>
<p>
	Are you sure you want to delete this subject?
	<ul class="list">
		<li>
			<div class="primary"><span>Subject Name</span><span><?php echo $oes->getSingleData("Subject", "Name", "ID = '$db_id'"); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>Subject Code</span><span><?php echo $oes->getSingleData("Subject", "Code", "ID = '$db_id'"); ?></span></div>
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
			url: "process.php?action=deletesubject",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListSubject();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>