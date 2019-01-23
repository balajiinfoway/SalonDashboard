<script>
	$(document).ready(function() {
		var dataTable = $('#data-table').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo $this->adminURL.'salon/fetch_data'; ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0, 2],
				"orderable": false,
			}, ],
		});
	});
</script>