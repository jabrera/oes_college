<span class="title">Message</span>
<p>
	Are you sure you want to delete the selected rooms?
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
			url: "process.php?action=deleteroom_data",
			data: {checkedData: [<?php 
			$ids = "";
			foreach($db_id as $id) {
				$ids .= "'$id',";
			}
			echo rtrim($ids);
			?>]},
			success: function(html) {
				showElement('none');
				refreshListRoom();
				$("#snackbar .wrapper").html(html);
			}
		});
	});
});
</script>