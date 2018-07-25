<span class="title">Message</span>
<p>
	Are you sure you want to delete this college?
	<ul class="list">
		<li>
			<div class="primary"><span>College Name</span><span><?php echo $oes->getSingleData("College", "Name", "ID = '$db_id'"); ?></span></div>
		</li>
		<li>
			<div class="primary"><span>College Code</span><span><?php echo $oes->getSingleData("College", "Code", "ID = '$db_id'"); ?></span></div>
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
			url: "process.php?action=deletecollege",
			data: {id: '<?php echo $db_id; ?>'},
			success: function(html) {
				showElement('none');
				refreshListCollege();
				$("#snackbar .wrapper").html(html);
			}
		})
	});
});
</script>