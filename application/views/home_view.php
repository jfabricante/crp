<!-- Items block -->
<section class="content home">
	<!-- row -->
	<div class="row">
		<!-- col-md-6 -->
		<div class="col-md-9">
			<!-- Box danger -->
			<div class="box box-danger">
				<!-- Content -->
				<div class="box-header with-border">
					<h4 class="text-uppercase">Welcome to Customer Relations Portal</h4>
					<p>Hi <?php echo $this->session->userdata('fullname'); ?></p>
					<p><?php echo $this->session->userdata('login') ? 'Last Log On: ' . date('M d, Y h:i A' ,strtotime($this->session->userdata('login'))) : ''  ?></p>
				</div>

				<div class="box-body">

					<!-- Item table -->
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>Document</th>
								<th>Details</th>
								<th>Date Created</th>
								<th>Remarks</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach($entities as $entity): ?>
								<tr>
									<td><?php echo $entity->category ?></td>
									<td><?php echo $entity->doc_name ?></td>
									<td><?php echo date('m-d-Y', strtotime($entity->datetime)) ?></td>
									<td></td>
								</tr>
							<?php endforeach ?>
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
		//$('.table').DataTable();
	});

	// Detroy modal
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	}); 
</script>