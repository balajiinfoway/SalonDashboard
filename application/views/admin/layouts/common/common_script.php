<script>
	$(document).ready(function() {
		$("#add-form-button").on("click", function() {
			var url = $(this).data('url');
			axios.get(url)
				.then(function(response) {
					setupModelDetails('Add <?= $pageTitle?>', response.data);
                    focusInput();
				})
				.catch(function(error) {
					console.log(error);
				});
		});
	});

	$(document).on('click', '.edit-form-button', function() {
		var url = $(this).data('url');
		axios.get(url)
			.then(function(response) {
				setupModelDetails('Edit <?= $pageTitle?>', response.data);
                focusInput();
			})
			.catch(function(error) {
				console.log(error);
			});
	});

	$(document).on('click', '.delete-button', function() {
		var url = $(this).data('url');
		axios.get(url)
			.then(function(response) {
				showNotice('success', 'delete record');
				refreshDatatable();
			})
			.catch(function(error) {
				console.log(error);
			});
	});

	$(document).on('submit', '#add-form', function(event) {
		event.preventDefault();
		showLoader();
		axios.post(
				$(this).attr('action'),
				new FormData(this)
			)
			.then(function(response) {
				if (response.data.status) {
					hideLoader();
					var errors = response.data.error;
					showValidationError(errors);
				} else {
					hideLoader();
					showNotice('success', '<?= $pageTitle?> Added Successfully');
					$('#common-popup').modal('hide');
					refreshDatatable();
				}
			})
			.catch(function(error) {
				hideLoader();
				var errors = error.response.data.errors;
				showValidationError(errors);
			});
	});

	$(document).on('submit', '#edit-form', function(event) {
		event.preventDefault();
		showLoader();
		axios.post(
				$(this).attr('action'),
				new FormData(this)
			)
			.then(function(response) {
				console.log(response.data);
				if (response.data.status) {
					hideLoader();
					var errors = response.data.error;
					showValidationError(errors);
				} else {
					hideLoader();
					showNotice('success', '<?= $pageTitle ?> Updated Successfully');
					$('#common-popup').modal('hide');
                    refreshDatatable();
				}
			})
			.catch(function(error) {
				hideLoader();
				var errors = error.response.data.errors;
				showValidationError(errors);
			});
	});

	function setupModelDetails(popupTitle, popupContent) {
		$('#popup-title').html(popupTitle);
		$('#popup-content').html(popupContent);
		$('#error-messages').addClass('d-none');
		$('#common-popup').modal();
	}

	function showValidationError(errors) {
		var errorMessages = '<ul>';
		errorMessages += '<li>' + errors + '</li>';
		errorMessages += '</ul>';

		$('#error-messages').html(errorMessages);
		$('#error-messages').removeClass('d-none');
		$('#error-messages').scrollTop();
		$('#common-popup').animate({
			scrollTop: 0
		}, 'slow');
	}

    function refreshDatatable(){
        $('#data-table').DataTable().ajax.reload();
    }

    function focusInput(){
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			startDate: new Date(),
			autoclose: true,
		});
		$(".start-datepicker").datepicker({
			format: 'yyyy-mm-dd',
			startDate: new Date(),
			autoclose: true,
		}).on('changeDate', function(selected) {
			var startDate = new Date(selected.date.valueOf());
			$('.end-datepicker').datepicker('setStartDate', startDate);
		}).on('clearDate', function(selected) {
			$('.end-datepicker').datepicker('setStartDate', null);
		});

		$(".end-datepicker").datepicker({
			format: 'yyyy-mm-dd',
			startDate: new Date(),
			autoclose: true,
		}).on('changeDate', function(selected) {
			var endDate = new Date(selected.date.valueOf());
			$('.start-datepicker').datepicker('setEndDate', endDate);
		}).on('clearDate', function(selected) {
			$('.start-datepicker').datepicker('setEndDate', null);
		});
    }

	// Image Validation
	$(document).on('change', '.imageValidate', function() {
		$extMsg = '<div class="col-form-label">Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF. </div>';
		$sizeMsg = '<div class="col-form-label">Maximum File Size Limit is 1MB. </div>';
		if ($('.btnSubmit').attr('disabled', false)) {
			$('.btnSubmit').attr('disabled', true);
		}
		var ext = $('.imageValidate').val().split('.').pop().toLowerCase();
		if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
			$(this).parent().parent().addClass('has-danger');
			$(this).addClass('form-control-danger');
			$(this).after($extMsg);
			a = 0;
		} else {
			var picsize = (this.files[0].size);
			if (picsize > 1000000) {
				console.log('sixe');
				$(this).parent().parent().addClass('has-danger');
				$(this).addClass('form-control-danger');
				$(this).after($sizeMsg);
				a = 0;
			} else {
				a = 1;
			}

			if (a == 1) {
				$(this).next('div').remove();
				$(this).removeClass('form-control-danger');
				$(this).parent().parent().removeClass('has-danger');
				$('.btnSubmit').attr('disabled', false);
			}
		}
	});
</script>