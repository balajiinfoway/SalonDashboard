<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $pageTitle; ?></h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <button type="button" class="btn btn-primary float-right" id="add-form-button">ADD</button>
        </div>
    </div>
</div>
<div class="page-body">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
				</div>
				<div class="card-block">
                    <div class="dt-responsive table-responsive">
                        <table id="data-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount Price</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view($this->folder.'/offer/add'); ?>