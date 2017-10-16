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

			<li class="<?php echo $menu == 'branch/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/branch/list_') ?>"><i class="fa fa-table"></i><span>Branches</span></a></li>

			<li class="<?php echo $menu == 'position/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/position/list_') ?>"><i class="fa fa-table"></i><span>Positions</span></a></li>

			<li class="<?php echo $menu == 'user/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/user/list_') ?>"><i class="fa fa-table"></i><span>Users</span></a></li>

		</ul><!-- /.sidebar-menu -->

	</section>
	<!-- /.sidebar -->
</aside>

