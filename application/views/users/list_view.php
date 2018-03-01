<!-- Items block -->
<section class="content users">
	<!-- row -->
	<div class="row">
		<!-- col-md-6 -->
		<div class="<?php echo $this->session->userdata('user_type') == 'Administrator' ? 'col-md-12' : 'col-md-9' ?>">
			<!-- Box danger -->
			<div class="box box-danger">
				<!-- Content -->

				<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
					<div class="box-header with-border">
						<a href="<?php echo base_url('index.php/user/form') ?>" data-toggle="modal" data-target=".bs-example-modal-sm">
							<button class="btn btn-flat btn-success pull-right">Add User <i class="fa fw fa-plus" aria-hidden="true"></i></button>
						</a>
					</div>
				<?php endif ?>

				<div class="box-body">
					<!-- Item table -->
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
									<th>Username</th>
									<th>Employee no.</th>
								<?php endif ?>
								<th>Fullname</th>
								<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
									<th>User type</th>
								<?php endif ?>
								<th>Branch</th>
								<th>Position</th>
								<th>Email</th>
								<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
									<th>Date Time</th>
									<th>Edit</th>
									<th>Delete</th>
								<?php endif ?>
							</tr>
						</thead>

						<tbody>
							<?php $count = 1; ?>
							<?php foreach($entities as $user): ?>
								<tr>
									<td><?php echo $count ?></td>
									<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
										<td><?php echo $user->username; ?></td>
										<td><?php echo $user->emp_no; ?></td>
									<?php endif ?>
									<td><?php echo ucwords(strtolower($user->fullname)); ?></td>
									<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
										<td><?php echo ucfirst($user->user_type); ?></td>
									<?php endif ?>
									<td><?php echo $user->branch; ?></td>
									<td><?php echo $user->position; ?></td>
									<td><?php echo $user->email; ?></td>
									<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
										<td><?php echo date('m/d/Y h:i A', strtotime($user->datetime)); ?></td>
										<td>
											<a href="<?php echo base_url('index.php/user/form/' . $user->id); ?>" data-toggle="modal" data-target=".bs-example-modal-sm">
												<i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Click this icon to edit this item."></i>
											</a>
										</td>
										<td>
											<a href="<?php echo base_url('index.php/user/notice/' . $user->id); ?>" data-toggle="modal" data-target=".bs-example-modal-sm">
												<i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Click this icon to delete this item."></i>
											</a>
										</td>
									<?php endif ?>
								</tr>
								<?php $count++; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					<!-- End of table -->
				</div>
				<!-- End of content -->
			</div>
			<!-- End of danger -->
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
<script type="text/javascript">
	$(document).ready(function() {
		$('.table').DataTable();
	});

	// Detroy modal
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	}); 
</script>