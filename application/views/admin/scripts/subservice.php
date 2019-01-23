<script>
	$(document).ready(function () {
    	var dataTable = $('#data-table').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"order": [],
    		"ajax": {
    			url: "<?php echo $this->adminURL.'subservice/fetch_data'; ?>",
    			type: "POST"
    		},
    		"columnDefs": [{
    			"targets": [2],
    			"orderable": false,
    		}, ],
    	});
    });
</script>