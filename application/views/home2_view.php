<style type="text/css">
	h1.text-danger {
		font-size: 50px
	}

	.gallery__item {
		padding: 15px;
		background: #d72b3b;
		color: #fff;
	}
</style>
<!-- Items block -->
<section class="content home2">
	<!-- row -->
	<div class="row text-center">
		<!-- col-md-6 -->
		<h1 class="text-danger">DISCOVER</h1>

		<div class="gallery">
			<div class="col-md-4">
				<img class="img-responsive" src="<?php echo base_url('resources/images/ceseries-new.jpg') ?>" />
				<div class="text-left text-danger gallery__item">
					<h3 class="gallery-header">N-SERIES</h3>
					<p class="gallery-desc">Light-Duty Trucks</p>
				</div>
			</div>
			<div class="col-md-4">
				<img class="img-responsive" src="<?php echo base_url('resources/images/f-series-updated.jpg') ?>" />
				<div class="text-left text-danger gallery__item">
					<h3 class="gallery-header">F-SERIES</h3>
					<p class="gallery-desc">Medium-Duty Trucks</p>
				</div>
			</div>
			<div class="col-md-4">
				<img class="img-responsive" src="<?php echo base_url('resources/images/nseries-new.jpg') ?>" />
				<div class="text-left text-danger gallery__item">
					<h3 class="gallery-header">C&E Series</h3>
					<p class="gallery-desc">Heavy-Duty Trucks</p>
				</div>
			</div>
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

	function AccessClipboardData() {
		try {
			window.clipboardData.setData('text', "");
		} catch (err) {
			txt = "There was an error on this page.\n\n";
			txt += "Error description: " + err.description + "\n\n";
			txt += "Click OK to continue.\n\n";
			console.log(txt);
		}
	}

	setInterval("AccessClipboardData()", 300);
</script>