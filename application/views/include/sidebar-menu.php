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
			
			<?php $current_menu = $this->uri->uri_string(); ?>

			<li class="<?php echo $current_menu == 'login/home' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/login/home') ?>"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a></li>

			<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
				<li class="<?php echo $current_menu == 'category/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/category/list_') ?>"><i class="fa fa-tags" aria-hidden="true"></i><span>Categories</span></a></li>
			<?php endif ?>

			<?php
				$group_menu = array_map(function($row) {
					return trim('docs/category_content/' . $row['id']);
				}, $sub_menus);
			?>

			<li class="treeview <?php echo in_array($current_menu, $group_menu) ? 'active' : ''; ?>">
			<!-- <li class="treeview active"> -->
				<a href="#">
					<i class="fa fa-newspaper-o"></i> <span>Documents</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<!-- group menu items -->
				<ul class="treeview-menu">

					<?php foreach($sub_menus as $menu): ?>
						<?php if (in_array($this->session->userdata('user_type'), array('Vesi')) && $menu['id'] == 11): ?>
							<li class="<?php echo $current_menu == ('docs/category_content/' . $menu['id']) ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/docs/category_content/' . $menu['id']) ?>"><i class="fa fa-circle-o"></i><span><?php echo $menu['name'] ?></span></a></li>
						<?php endif ?>

						<?php if (in_array($this->session->userdata('user_type'), array('Administrator', 'Dealer')) && $menu['id'] != 11): ?>
							<li class="<?php echo $current_menu == ('docs/category_content/' . $menu['id']) ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/docs/category_content/' . $menu['id']) ?>"><i class="fa fa-circle-o"></i><span><?php echo $menu['name'] ?></span></a></li>
						<?php endif ?>
					<?php endforeach ?>
				</ul>
			</li>

			<?php if (in_array($this->session->userdata('user_type'), array('Administrator', 'Dealer'))): ?>
				<li class="<?php echo $current_menu == 'request/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/request/list_') ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i><span>Requests</span></a></li>

				<li class="<?php echo $current_menu == 'request/approved_list' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/request/approved_list') ?>"><i class="fa fa-check-circle" aria-hidden="true"></i><span>Approved Requests</span></a></li>
			<?php endif ?>

			<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
				<li class="<?php echo $current_menu == 'branch/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/branch/list_') ?>"><i class="fa fa-share-alt" aria-hidden="true"></i><span>Branches</span></a></li>

				<li class="<?php echo $current_menu == 'position/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/position/list_') ?>"><i class="fa fa-sitemap" aria-hidden="true"></i><span>Positions</span></a></li>
			<?php endif ?>

			<?php if (in_array($this->session->userdata('user_type'), array('Administrator', 'Dealer'))): ?>
				<li class="<?php echo $current_menu == 'user/list_' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/user/list_') ?>"><i class="fa fa-user" aria-hidden="true"></i><span>Users</span></a></li>
			<?php endif ?>

			<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>

				<li class="<?php echo $current_menu == 'user/logs' ? 'active' : ''; ?>"><a href="<?php echo base_url('index.php/user/logs') ?>"><i class="fa fa-history" aria-hidden="true"></i><span>User's Log</span></a></li>
			<?php endif ?>

		</ul><!-- /.sidebar-menu -->

	</section>
	<!-- /.sidebar -->
</aside>

