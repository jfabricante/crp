<!-- Items block -->
<section class="content requests">
	<!-- row -->
	<div class="row">
		<!-- col-md-6 -->
		<div class="col-md-9">
			<!-- Box danger -->
			<?php echo $this->session->flashdata('message'); ?>

			<div class="box box-danger">
				<!-- Content -->
				<div class="box-header with-border">
					<a href="<?php echo base_url('index.php/request/form') ?>" data-toggle="modal" data-target=".bs-example-modal-sm">
						<button class="btn btn-flat btn-success pull-right">Add New Request <i class="fa fw fa-plus" aria-hidden="true"></i></button>
					</a>
				</div>

				<div class="box-body">
					<!-- Item table -->
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Purpose</th>
								<th>Justification</th>
								<th>Document</th>
								<th>Permission</th>
								<th>Requested by</th>
								<th></th>
								<?php if($this->session->userdata('user_type') == 'Administrator'): ?>
									<th></th>
								<?php endif ?>
								<th></th>
							</tr>
						</thead>

						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($entities as $entity): ?>
								<tr>
									<td><?php echo $count; ?></td>
									<td><?php echo $entity->purpose; ?></td>
									<td><?php echo $entity->justification; ?></td>
									<td><?php echo $entity->doc_name; ?></td>
									<td><?php echo ucfirst($entity->permission); ?></td>
									<td><?php echo $entity->fullname; ?></td>
									<td>
										<a href="<?php echo base_url('index.php/request/form/' . $entity->id); ?>"  data-toggle="modal" data-target=".bs-example-modal-sm">
											<i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Click this icon to edit this item."></i>
										</a>
									</td>
									<?php if($this->session->userdata('user_type') == 'Administrator'): ?>
										<td>
											<a href="<?php echo base_url('index.php/request/approve/' . $entity->id); ?>" >
												<i class="fa fa-check" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Click this icon to approve this item."></i>
											</a>
										</td>
									<?php endif ?>
									<td>
										<a href="<?php echo base_url('index.php/request/notice/' . $entity->id); ?>" data-toggle="modal" data-target=".bs-example-modal-sm">
											<i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Click this icon to remove this item."></i>
										</a>
									</td>
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