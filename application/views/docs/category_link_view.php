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
				<!-- <?php if ($this->session->userdata('user_type') == 'Administrator'): ?>
					<div class="box-header with-border">
						<a href="<?php echo base_url('index.php/docs/form') ?>" data-toggle="modal" data-target=".bs-example-modal-sm">
							<button class="btn btn-flat btn-success pull-right">Add Document <i class="fa fw fa-plus" aria-hidden="true"></i></button>
						</a>
					</div>
				<?php endif ?> -->

				<div class="box-body">
					<!-- Item table -->
					<table class="table table-condensed table-striped table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Document Name</th>
								<th>Link</th>
								<th>Views</th>
							</tr>
						</thead>

						<tbody>
							   <tr>
							  		<td>1</td>
							  		<td>C&E-Series</td>
							  		<td>
							  			<a href="<?php echo base_url('index.php/VESI/c_series');?>" target="_blank">
							  				<i class="fa fa-link"></i>	
							  			</a>

							  			
							  		</td>
							  		<td></td>
							  </tr>

							  <tr>
							  		<td>2</td>
							  		<td>F-Series</td>
							  		<td>
							  			<a href="<?php echo base_url('index.php/FSERIES/F_series');?>" target="_blank">
							  				<i class="fa fa-link"></i>	
							  			</a>

							  		</td>
							  		<td></td>
							  </tr>

							   <tr>
							  		<td>3</td>
							  		<td>N-Series</td>
							  		<td>
							  			<a href="<?php echo base_url('index.php/NSERIES/N_series'); ?>" target="_blank">
							  				<i class="fa fa-link"></i>	
							  			</a>

							  		</td>
							  		<td></td>
							  </tr>


							  <tr>
							  		<td>4</td>
							  		<td>UCR/UCS</td>
							  		<td>
							  			<a href="<?php echo base_url('index.php/USERIES/U_series') ?>" target="_blank">
							  					<i class="fa fa-link"></i>	
							  			</a>
							  		</td>
							  		<td></td>
							  </tr>

							  <tr>
							  		<td>5</td>
							  		<td>TFR/TFS</td>
							  		<td>
							  			<a href="<?php echo base_url('index.php/TSERIES/T_series'); ?>" target="_blank">
							  					<i class="fa fa-link"></i>	
							  				</a>
							  		</td>
							  		<td></td>
							  </tr>


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

    // setInterval("AccessClipboardData()", 300);
</script>

