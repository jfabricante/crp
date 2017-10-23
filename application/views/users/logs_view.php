<!-- Items block -->
<section class="content users">
	<!-- row -->
	<div class="row">
		<!-- col-md-6 -->
		<div class="col-md-7">
			<!-- Box danger -->
			<div class="box box-danger">
				<!-- Content -->

				<div class="box-body">
					<!-- Item table -->
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Dealer</th>
								<th>Name</th>
								<th>User type</th>
								<th>Log in</th>
								<th>Log out</th>
							</tr>
						</thead>

						<tbody>
							<?php $count = 1; ?>
							<?php foreach($entities as $user): ?>
								<tr>
									<td><?php echo $count ?></td>
									<td><?php echo $user->branch; ?></td>
									<td><?php echo $user->fullname; ?></td>
									<td><?php echo $user->user_type; ?></td>
									<td><?php echo date('m-d-Y; h:i A', strtotime($user->login)); ?></td>
									<td><?php echo date('m-d-Y; h:i A', strtotime($user->logout)); ?></td>
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