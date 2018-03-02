<link href="<?php echo base_url('resources/plugins/select2/css/select2.min.css');?>" rel="stylesheet" >
<link href="<?php echo base_url('resources/js/printjs/dist/print.min.css') ?>" rel="stylesheet" type="text/css" >
<!-- Items block -->
<section class="content docs">
	<!-- row -->
	<div class="row">
		<!-- col-md-6 -->
		<div class="col-md-6">
			<!-- Box danger -->
			<?php echo $this->session->flashdata('message'); ?>

			<div class="box box-danger">
				<!-- Content -->
				<?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
					<div class="box-header with-border">
						<a href="<?php echo base_url('index.php/docs/form') ?>" data-toggle="modal" data-target=".bs-example-modal-sm">
							<button class="btn btn-flat btn-success pull-right">Add Document <i class="fa fw fa-plus" aria-hidden="true"></i></button>
						</a>
					</div>
				<?php endif ?>

				<div class="box-body">
					<!-- Item table -->
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Document Name</th>
								<th>Category</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							<?php $count = 1; ?>
							<?php foreach ($entities as $entity): ?>
								<tr>
									<td><?php echo $count; ?></td>
									<td><?php echo $entity['doc_name']; ?></td>
									<td><?php echo $entity['category']; ?></td>
									<td>
										<!-- Single button -->
										<div class="btn-group">
											<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Select
												<span class="caret"></span>
											</button>
											<?php if($this->session->userdata('user_type') == 'Administrator'): ?>
												<ul class="dropdown-menu">
													<li><a href="<?php echo  base_url('index.php/docs/modal_content/' . $entity['id']) ?>" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>

													<li><a href="<?php echo base_url('resources/docs/' . $entity['file_name']) ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print</a></li>

													<li><a href="<?php echo base_url('index.php/docs/download_doc/' . $entity['id']) ?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a></li>

													<li><a href="<?php echo base_url('index.php/docs/archive/' . $entity['id']) ?>"><i class="fa fa-archive" aria-hidden="true"></i> Archive</a></li>

													<li><a href="<?php echo base_url('index.php/docs/form/' . $entity['id']); ?>" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>

													<li><a href="<?php echo base_url('index.php/docs/notice/' . $entity['id']); ?>" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
												</ul>
											<?php else: ?>
												<ul class="dropdown-menu">
													<li><a href="<?php echo  base_url('index.php/docs/modal_content/' . $entity['id']) ?>" data-toggle="modal" data-target=".bs-example-modal-md"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
													<?php if ($entity['has_menu']): ?>
														<?php if ($entity['print_doc']): ?>
															<li><a href="<?php echo base_url('resources/docs/' . $entity['file_name']) ?>" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print</a></li>
														<?php endif ?>

														<?php if ($entity['download_doc']): ?>
															<li><a href="<?php echo base_url('index.php/docs/download_doc/' . $entity['id']) ?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a></li>
														<?php endif ?>

														<?php if ($entity['archive_doc']): ?>
															<li><a href="<?php echo base_url('index.php/docs/archive/' . $entity['id']) ?>"><i class="fa fa-archive" aria-hidden="true"></i> Archive</a></li>
														<?php endif ?>

														<?php if ($entity['edit_doc']): ?>
															<li><a href="<?php echo base_url('index.php/docs/form/' . $entity['id']); ?>" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a></li>
														<?php endif ?>

														<?php if ($entity['delete_doc']): ?>
															<li><a href="<?php echo base_url('index.php/docs/notice/' . $entity['id']); ?>" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a></li>
														<?php endif ?>
													<?php endif; ?>
												</ul>
											<?php endif ?>
										</div>
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
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">

		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">

		</div>
	</div>
</div>
<script src="<?php echo base_url('resources/plugins/select2/js/select2.min.js');?>"></script>
<script src="<?php echo base_url('resources/js/printjs/dist/print.min.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.table').DataTable();
	});

	// Detroy modal
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});

	$(function() {
		$(this).bind("contextmenu", function(e) {
			e.preventDefault();
		});
	});

    function AccessClipboardData() {
		try {
			window.clipboardData.setData('text', "No print data");
		} catch (err) {
			txt = "There was an error on this page.\n\n";
			txt += "Error description: " + err.description + "\n\n";
			txt += "Click OK to continue.\n\n";
			console.log(txt);
		}
    }

    setInterval("AccessClipboardData()", 300);
</script>

