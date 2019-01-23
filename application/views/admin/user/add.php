	<form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>user/add">
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="sub-title font-weight-bold">User Details</h4>
				</div>
				<div class="col-sm-6">
                    <div class="form-group form-default">
                        <label class="float-label">Name</label>
						<input type="text" name="name" class="form-control" required>
						<span class="form-bar"></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group form-default">
						<label class="float-label">Email</label>
						<input type="text" name="email" class="form-control" required>
						<span class="form-bar"></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group form-default">
						<label class="float-label">Password</label>
						<input type="password" name="password" class="form-control" required>
						<span class="form-bar"></span>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group form-default">
						<label class="float-label">Confirm Password</label>
						<input type="password" name="passconf" class="form-control" required>
						<span class="form-bar"></span>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
	</form>