<script>
$(document).ready(function () {
    	var dataTable = $('#user_data').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"order": [],
    		"ajax": {
    			url: "<?php echo $this->adminURL.'User/fetch_data'; ?>",
    			type: "POST"
    		},
    		"columnDefs": [{
    			"targets": [0, 3],
    			"orderable": false,
    		}, ],
    	});
    });
</script>