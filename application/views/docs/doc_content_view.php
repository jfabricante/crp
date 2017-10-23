<iframe src="<?php echo base_url('ViewerJS/#../resources/docs/' . $filename) ?>" width="600px" height="600px" allowfullscreen  webkitallowfullscreen class="iframe"></iframe>
<script type="text/javascript">
	$('.iframe').ready(function() {
	   setTimeout(function() {
			$('.iframe').contents().find('.download').remove();
			$('.iframe').contents().find('.about').remove();
	   }, 100);
	});
</script>
					