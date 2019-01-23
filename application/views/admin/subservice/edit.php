<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>subservice/update/<?= $id ?>"
 enctype="multipart/form-data">
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="sub-title font-weight-bold">Service Details</h4>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Service</label>
					<select class="form-control" name="service_id" required>
						<option value="">Select Type</option>
						<?php
                            if($services){
                                foreach($services as $service){
                            ?>
						<option value="<?= $service['id'] ?>" <?= $record['service_id'] == $service['id']?'selected':'' ?>>
							<?= $service['name'] ?>
						</option>
						<?php
                                }
                            }
                            ?>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo $record['name']; ?>" required>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group form-default">
					<label class="float-label">Price</label>
					<input type="text" name="price" class="form-control" value="<?php echo $record['price']; ?>" required>
					<span class="form-bar"></span>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group form-default">
					<label class="float-label">Details</label>
					<textarea name="details" class="form-control" required><?php echo $record['details']; ?></textarea>
					<span class="form-bar"></span>
				</div>
			</div>
			<?php
			if($images){
				foreach($images as $image){
			?>
			<div class="col-sm-4 text-center" style="margin-bottom:10px">
				<img style="margin-bottom:5px;" src="<?= base_url() ?>/assets/upload/subservice/<?= $image['image'] ?>" width="60" height="100">
				<br>
				<a class="btn btn-danger remove-image" data-url="<?= $this->adminURL ?>subservice/imageDelete/<?= $image['id'] ?>">
					Remove
				</a>
			</div>
			<?php
				}
			}
			?>
			<div class="form-group col-sm-12 row sub-image">
				<label class="col-sm-2 col-form-label">Image</label>
				<div class="col-sm-8">
					<input type="file" class="form-control imageValidate" name="subServiceImage[]" accept=".png, .jpg, .jpeg">
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-info  add-sub-image">Add Image</button>
				</div>
			</div>
			<template id="sub-img">
				<div class="form-group col-sm-12 row">
					<label class="col-sm-2 col-form-label">Image</label>
					<div class="col-sm-8">
						<input type="file" class="form-control imageValidate" name="subServiceImage[]" accept=".png, .jpg, .jpeg">
					</div>
					<div class="col-sm-2">
						<a class="btn btn-danger add-image-remove">
							Remove
						</a>
					</div>
				</div>
			</template>
		</div>
	</div>
	<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
</form>