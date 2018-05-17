<!-- Items block -->
<section class="content change-password-form">
	<!-- row -->
	<div class="row">
		<!-- col-md-6 -->
		<div class="col-md-6">
			<?php echo $this->session->flashdata('message'); ?>

			<form role="form" action="<?php echo base_url('index.php/user/password_store') ?>" method="post">
				<!-- Box danger -->
				<div class="box box-danger">
					<!-- Content -->

					<div class="box-body">
						<div class="form">
							<div class="form-group">
								<label for="old_password">Old Password</label>
								<input type="password" class="form-control" id="old_password" name="old_password" required autofocus />
							</div>

							<div class="form-group">
								<label for="new_password">New Password</label>
								<input type="password" class="form-control" id="new_password" name="new_password" required autofocus />
							</div>

							<div class="form-group">
								<label for="conf_password">Confirm Password</label>
								<input type="password" class="form-control" id="conf_password" name="conf_password" required autofocus />
							</div>

						</div>
					</div>
					<!-- End of content -->

					<!-- Box footer -->
					<div class="box-footer text-right">
						<div class="form-group">
							<input type="submit" value="Submit" class="btn btn-flat btn-danger">
						</div>
					</div>
					<!-- End of box footer -->
				</div>
				<!-- End of danger -->
			</form>
			<!-- End of form -->
		</div>
		<!-- End of col-md-6 -->
	</div>
	<!-- End of row -->
</section>
<div class="modal fade bs-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>
