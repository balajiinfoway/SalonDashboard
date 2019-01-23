	<form role="form" id="add-form" autocomplete="off" enctype="multipart/form-data" method="post" action="<?= $this->adminURL ?>subservice/add">
		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="sub-title font-weight-bold">Sub Service Details</h4>
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
                            <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
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
						<input type="text" name="name" class="form-control" required>
						<span class="form-bar"></span>
					</div>
				</div>
				<div class="col-sm-6">
                    <div class="form-group form-default">
                        <label class="float-label">Price</label>
						<input type="text" name="price" class="form-control" required>
						<span class="form-bar"></span>
					</div>
				</div>
				<div class="col-sm-12">
                    <div class="form-group form-default">
                        <label class="float-label">Details</label>
						<textarea name="details" class="form-control" required></textarea>
						<span class="form-bar"></span>
					</div>
				</div>

				<!-- <div class="col-sm-6">
                    <div class="form-group form-default">
                        <label class="float-label">Image</label>
						<input type="file" name="serviceImage" class="form-control" requierd>
						<span class="form-bar"></span>
					</div>
				</div> -->

			</div>
		</div>
		<?php $this->load->view($this->folder.'/layouts/common/common_popup_footer'); ?>
	</form>