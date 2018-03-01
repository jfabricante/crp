<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url('resources/images/default.png');?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>	<?php echo $this->session->userdata('fullname'); ?></p>
			</div>
		</div>

		<!-- Seach form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			
			<?php $menu = $this->uri->uri_string(); ?>

			<li class="<?php echo $menu == 'login/home' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/login/home') ?>"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a></li>

			<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
				<li class="<?php echo $menu == 'category/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/category/list_') ?>"><i class="fa fa-tags" aria-hidden="true"></i><span>Categories</span></a></li>
			<?php endif ?>

			<li class="<?php echo $menu == 'docs/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/docs/list_') ?>"><i class="fa fa-file" aria-hidden="true"></i><span>Documents</span></a></li>

			<li class="<?php echo $menu == 'request/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/request/list_') ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Requests</span></a></li>

			<li class="<?php echo $menu == 'request/approved_list' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/request/approved_list') ?>"><i class="fa fa-check-circle" aria-hidden="true"></i><span>Approved Requests</span></a></li>

			<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
				<li class="<?php echo $menu == 'branch/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/branch/list_') ?>"><i class="fa fa-share-alt" aria-hidden="true"></i><span>Branches</span></a></li>

				<li class="<?php echo $menu == 'position/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/position/list_') ?>"><i class="fa fa-sitemap" aria-hidden="true"></i><span>Positions</span></a></li>
			<?php endif ?>

				<li class="<?php echo $menu == 'user/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/user/list_') ?>"><i class="fa fa-user" aria-hidden="true"></i><span>Users</span></a></li>

			<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>

				<li class="<?php echo $menu == 'user/logs' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/user/logs') ?>"><i class="fa fa-history" aria-hidden="true"></i><span>User's Log</span></a></li>
			<?php endif ?>

		</ul><!-- /.sidebar-menu -->

	</section>
	<!-- /.sidebar -->
</aside>

