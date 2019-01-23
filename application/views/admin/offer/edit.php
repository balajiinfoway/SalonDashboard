<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>offer/update/<?= $id ?>"
 enctype="multipart/form-data">
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo $record['name']; ?>"
					 required>
					<span class="form-bar"></span>
				</div>
			</div>
            <div class="col-sm-6">
                <div class="form-group form-default">
                    <label class="float-label">Discount</label>
                    <input type="text" name="discount" class="form-control" value="<?php echo $record['discount']; ?>">
                    <span class="form-bar"></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group form-default">
                    <label class="float-label">Coupon Code</label>
                    <input type="text" name="coupon_code" class="form-control" value="<?php echo $record['coupon_code']; ?>">
                    <span class="form-bar"></span>
                </div>
            </div>
            <div class="col-sm-6">
                    <div class="form-group form-default">
                        <label class="float-label">Start Date</label>
						<input type="text" name="start_date" class="form-control start-datepicker" value="<?php echo $record['start_date']; ?>" required>
						<span class="form-bar"></span>
					</div>
				</div>
				<div class="col-sm-6">
                    <div class="form-group form-default">
                        <label class="float-label">End Date</label>
						<input type="text" name="end_date" class="form-control end-datepicker" value="<?php echo $record['end_date']; ?>" required>
						<span class="form-bar"></span>
					</div>
				</div>
                <div class="col-sm-6">
                    <div class="form-group form-default">
                        <label class="float-label">Offer Image</label>
						<input type="file" name="offerImage" class="form-control" requierd>
						<span class="form-bar"></span>
                        <?php if($record['image']) {  ?>
                        <img src="<?= base_url() ?>/assets/upload/offer/<?= $record['image'] ?>" width="60px" height="60px">
                        <?php } ?>
					</div>
				</div>

		</div>
	</div>
	<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
</form>