<script>
	$(document).ready(function() {
		var dataTable = $('#data-table').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo $this->adminURL.'offer/fetch_data'; ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [0,4,5,6],
				"orderable": false,
			}, ],
		});
    });
</script>