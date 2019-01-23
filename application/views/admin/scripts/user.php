<script>
$(document).ready(function () {
    	var dataTable = $('#data-table').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"order": [],
    		"ajax": {
    			url: "<?php echo $this->adminURL.'User/fetch_data'; ?>",
    			type: "POST"
    		},
    		"columnDefs": [{
    			"targets": [2, 3],
    			"orderable": false,
    		}, ],
    	});
    });
</script>