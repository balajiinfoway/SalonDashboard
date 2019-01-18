<nav class="pcoded-navbar">
	<div class="sidebar_toggle">
		<a href="#">
			<i class="icon-close icons"></i>
		</a>
	</div>
	<div class="pcoded-inner-navbar main-menu">
		<ul class="pcoded-item pcoded-left-item">
			<li class="<?= $menu_active == ''?'active':''?>">
				<a href="<?= base_url() ?>">
					<span class="pcoded-micon">
						<i class="ti-home"></i>
					</span>
					<span class="pcoded-mtext">Dashboard</span>
				</a>
			</li>
			<li class="<?= $menu_active == 'user'?'active':''?>">
				<a href="<?= $this->adminURL ?>user">
					<span class="pcoded-micon">
						<i class="ti-user"></i>
					</span>
					<span class="pcoded-mtext">User</span>
				</a>
			</li>
			<li class="<?= $menu_active == 'service'?'active':''?>">
				<a href="<?= $this->adminURL ?>service">
					<span class="pcoded-micon">
						<i class="ti-gallery"></i>
					</span>
					<span class="pcoded-mtext">Service</span>
				</a>
			</li>
		</ul>
	</div>
</nav>