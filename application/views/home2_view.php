<style type="text/css">
	h1.text-danger {
		font-size: 50px
	}

	.gallery__item {
		cursor: pointer;
	}

	.gallery__footer {
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
			<a href="<?php echo base_url('index.php/NSERIES/N_series'); ?>" target="_blank">
				<div class="col-md-3 gallery__item">
					<img class="img-responsive" src="<?php echo base_url('resources/images/gr1_9680-qkr-truck-quarter-left-crop.jpg') ?>" />
					<div class="text-left text-danger gallery__footer">
						<h4 class="gallery-header">N-SERIES</h4>
						<p class="gallery-desc">Light-Duty Trucks</p>
					</div>
				</div>
			</a>

			<a href="<?php echo base_url('index.php/FSERIES/F_series');?>" target="_blank">
				<div class="col-md-3 gallery__item">
					<img class="img-responsive" src="<?php echo base_url('resources/images/frr90-live-crop.jpg') ?>" />
					<div class="text-left text-danger gallery__footer">
						<h4 class="gallery-header">F-SERIES</h4>
						<p class="gallery-desc">Medium-Duty Trucks</p>
					</div>
				</div>
			</a>

			<a href="<?php echo base_url('index.php/VESI/c_series');?>" target="_blank">
				<div class="col-md-3 gallery__item">
					<img class="img-responsive" src="<?php echo base_url('resources/images/ceseries-arcwhite-cyz-3-crop.jpg') ?>" />
					<div class="text-left text-danger gallery__footer">
						<h4 class="gallery-header">C&E Series</h4>
						<p class="gallery-desc">Heavy-Duty Trucks</p>
					</div>
				</div>
			</a>
		</div>
		<!-- End of col-md-6 -->
	</div>
	<!-- End of row -->
	
	<!-- Spacing between row -->
	<br>

	<!-- row -->
	<div class="row text-center">
		<a href="<?php echo base_url('index.php/USERIES/U_series') ?>" target="_blank">
			<div class="col-md-3 gallery__item">
				<img class="img-responsive" src="<?php echo base_url('resources/images/mu-x-red-spinel-crop.jpg') ?>" />
				<div class="text-left text-danger gallery__footer">
					<h4 class="gallery-header">mu-X</h4>
					<p class="gallery-desc">Center of Attraction</p>
				</div>
			</div>
		</a>

		<a href="<?php echo base_url('index.php/TSERIES/T_series'); ?>" target="_blank">
			<div class="col-md-3 gallery__item">
				<img class="img-responsive" src="<?php echo base_url('resources/images/dmax-xseries-white-crop.jpg') ?>" />
				<div class="text-left text-danger gallery__footer">
					<h4 class="gallery-header">D-MAX</h4>
					<p class="gallery-desc">Tough Enough for Anything</p>
				</div>
			</div>
		</a>
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