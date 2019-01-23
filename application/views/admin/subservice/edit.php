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

		</div>
	</div>
	<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
</form>