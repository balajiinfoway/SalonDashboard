<form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>offer/add">
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Name</label>
					<input type="text" name="name" class="form-control" required>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Discount</label>
					<input type="text" name="discount" class="form-control">
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Coupon Code</label>
					<input type="text" name="coupon_code" class="form-control">
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Offer Image</label>
					<input type="file" name="offerImage" class="form-control" requierd>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Start Date</label>
					<input type="text" name="start_date" class="form-control start-datepicker" required>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">End Date</label>
					<input type="text" name="end_date" class="form-control end-datepicker" required>
					<span class="form-bar"></span>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
</form>