<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>service/update/<?= $id ?>"
 enctype="multipart/form-data">
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="sub-title font-weight-bold">Service Details</h4>
			</div>
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
					<label class="float-label">Type</label>
					<select class="form-control" name="type" required>
						<option value="">Select Type</option>
						<option value="male" <?= $record['type'] == 'male'?'selected':'' ?> >Male</option>
						<option value="female" <?= $record['type'] == 'female'?'selected':'' ?>>Female</option>
						<option value="both" <?= $record['type'] == 'both'?'selected':'' ?>>Both</option>
					</select>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Service Image</label>
					<input type="file" name="serviceImage" class="form-control" requierd>
					<span class="form-bar"></span>
					<?php if($record['image']) {  ?>
					<img src="<?= base_url() ?>/assets/upload/service/<?= $record['image'] ?>" width="60px" height="60px">
					<?php } ?>
				</div>
			</div>

		</div>
	</div>
	<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
</form>