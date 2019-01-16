<div class="login-card card-block auth-body mr-auto ml-auto">
	<form class="md-float-material" method="post" action="<?= $this->adminURL ?>Login">
		<div class="text-center">
			<img src="<?= base_url() ?>assets/images/logo.png" alt="logo.png">
		</div>
		<div class="auth-box">
			<div class="row m-b-20">
				<div class="col-md-12">
					<h3 class="text-left txt-primary">Sign In</h3>
                    <?php  $this->load->view($this->folder.'/layouts/common/errors'); ?>
                </div>
			</div>
			<hr/>
			<div class="input-group">
				<input type="email" name="email" class="form-control" placeholder="Your Email Address">
				<span class="md-line"></span>
			</div>
			<div class="input-group">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<span class="md-line"></span>
			</div>
			<div class="row m-t-25 text-left">
				<div class="col-12">
					<div class="checkbox-fade fade-in-primary d-">
						<label>
							<input type="checkbox" value="">
							<span class="cr">
								<i class="cr-icon icofont icofont-ui-check txt-primary"></i>
							</span>
							<span class="text-inverse">Remember me</span>
						</label>
					</div>
					<div class="forgot-phone text-right f-right">
						<a href="" class="text-right f-w-600 text-inverse"> Forgot Password?</a>
					</div>
				</div>
			</div>
			<div class="row m-t-30">
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-10">
					<p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>
					<p class="text-inverse text-left">
					</p>
				</div>
			</div>

		</div>
	</form>
	<!-- end of form -->
</div>