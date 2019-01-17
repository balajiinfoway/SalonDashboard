<script>
    $(document).ready(function () {
		$("#add-form-button").on("click", function(){
            console.log("hello world");

			setupModelDetails('Add <?= $pageTitle?>', $('#add-form-contents').html());
		});
    });

    $(document).on('click', '.edit-form-button', function(){
		var url = $(this).data('url');
		axios.get(url)
		.then(function (response) {
			setupModelDetails('Edit <?= $pageTitle?>', response.data);
		})
		.catch(function (error) {
			console.log(error);
		});
    });

    $(document).on('click', '.delete-button', function(){
		var url = $(this).data('url');
		axios.get(url)
		.then(function (response) {
			showNotice('success', 'delete record');
			setTimeout(function(){
				window.location.reload();
			}, 1000);
		})
		.catch(function (error) {
			console.log(error);
		});
    });

    $(document).on('submit', '#add-form', function (event) {
			event.preventDefault();
            showLoader();
			axios.post(
				$(this).attr('action'),
				new FormData(this)
			)
			.then(function (response) {
                if(response.data.status){
                    hideLoader();
                    var errors = response.data.error;
                    showValidationError(errors);
                }else{
                    hideLoader();
                    showNotice('success', '@yield("title") Added Successfully');
                    $('#common-popup').modal('hide');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                }
			})
			.catch(function (error) {
                hideLoader();
				var errors = error.response.data.errors;
				showValidationError(errors);
			});
	});

    $(document).on('submit', '#edit-form', function (event) {
		event.preventDefault();
        showLoader();
		axios.post(
			$(this).attr('action'),
			new FormData(this)
		)
		.then(function (response) {
            console.log(response.data);
            if(response.data.status){
                hideLoader();
                var errors = response.data.error;
                showValidationError(errors);
            }else{
                hideLoader();
                showNotice('success', '<?= $pageTitle ?> Updated Successfully');
                $('#common-popup').modal('hide');
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
		})
		.catch(function (error) {
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
        $('#common-popup').animate({ scrollTop: 0 }, 'slow');
    }
</script>