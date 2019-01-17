<form role="form" id="edit-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>user/update/<?= $id ?>"
 enctype="multipart/form-data">
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
				<h4 class="sub-title font-weight-bold">User Details</h4>
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
						<label class="float-label">Email</label>
						<input type="text" name="email" class="form-control" value="<?php echo $record['email']; ?>" required>
						<span class="form-bar"></span>
					</div>
				</div>

		</div>
	</div>
	<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
</form>
