<script>
	$(document).ready(function() {
		var dataTable = $('#data-table').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				url: "<?php echo $this->adminURL.'subservice/fetch_data'; ?>",
				type: "POST"
			},
			"columnDefs": [{
				"targets": [3],
				"orderable": false,
			}, ],
		});
	});

	$(document).on('click', '.add-sub-image', function(event) {
		var html = $('#sub-img').html();
		$(".sub-image").after(html);
	});

	$(document).on('click', '.add-image-remove', function() {
		$(this).parent().parent().remove();
	});

	$(document).on('click', '.remove-image', function() {
		var url = $(this).data('url');
		var ele = $(this);
		axios.get(url)
		.then(function(response) {
			ele.parent().remove();
			showNotice('success', 'Image deleted Successfully');
		})
		.catch(function(error) {
			console.log(error);
		});
	});
</script>