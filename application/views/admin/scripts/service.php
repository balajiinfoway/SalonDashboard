<script>
$(document).ready(function () {
    	var dataTable = $('#data-table').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"order": [],
    		"ajax": {
    			url: "<?php echo $this->adminURL.'service/fetch_data'; ?>",
    			type: "POST"
    		},
    		"columnDefs": [{
    			"targets": [],
    			"orderable": false,
    		}, ],
    	});
    });
</script>