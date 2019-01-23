<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>salon/update/<?= $id ?>"
 enctype="multipart/form-data">
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group form-default">
					<label class="float-label">Name</label>
					<input type="text" name="name" class="form-control" maxlength="190" value="<?php echo $record['name']; ?>"
					 required>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group form-default">
					<label class="float-label">Decription</label>
					<textarea name="decription" class="form-control"><?php echo $record['decription']; ?></textarea>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Latitude</label>
					<input type="text" name="latitude" class="form-control" value="<?php echo $record['latitude']; ?>">
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Longitude</label>
					<input type="text" name="longitude" class="form-control" value="<?php echo $record['longitude']; ?>"
					 requierd>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group form-default">
					<label class="float-label">Address</label>
					<textarea name="address" class="form-control" required><?php echo $record['address']; ?></textarea>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Image</label>
					<input type="file" name="salonImage" class="form-control" requierd="">
					<span class="form-bar"></span>
					<?php if($record['image']) {  ?>
                        <img src="<?= base_url() ?>/assets/upload/salon/<?= $record['image'] ?>"
                        width="60px" height="60px">
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
</form>