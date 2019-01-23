	<form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>service/add">
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="sub-title font-weight-bold">Service Details</h4>
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
						<label class="float-label">Type</label>
                        <select class="form-control" name="type" required>
                            <option value="">Select Type</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="both">Both</option>
                        </select>
					</div>
				</div>
				<div class="col-sm-6">
                    <div class="form-group form-default">
                        <label class="float-label">Image</label>
						<input type="file" name="serviceImage" class="form-control" requierd>
						<span class="form-bar"></span>
					</div>
				</div>

			</div>
		</div>
		<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
	</form>