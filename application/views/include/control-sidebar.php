<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">

	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-user"></i></a></li>
		<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">

		<!-- Home tab content -->
		<div class="tab-pane active" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading">My Profile</h3>
			<div class="form-group">
				<label class="control-sidebar-subheading">
					Name
				</label>
				<p>
					<?php echo $this->session->userdata('fullname'); ?>
				</p>
			</div><!-- /.form-group -->
		</div><!-- /.tab-pane -->

		<!-- Stats tab content -->
		<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->

		<!-- Settings tab content -->
		<div class="tab-pane" id="control-sidebar-settings-tab">
			<form method="post">
			<h3 class="control-sidebar-heading">General Settings</h3>

			<ul class="control-sidebar-menu">
				<li>
					<a href="<?php echo base_url('index.php/user/change_password_form') ?>">
						<i class="menu-icon fa fa-key bg-red"></i>

						<div class="menu-info">
						<h4 class="control-sidebar-subheading" style="margin-top: 10px;">Change Password</h4>

						</div>
					</a>
				</li>
			</ul>
			</form>
		</div><!-- /.tab-pane -->

	</div>
	<!-- End of Tab panes -->
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
	immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
