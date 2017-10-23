<link href="<?php echo base_url('resources/plugins/select/css/bootstrap-select.min.css');?>" rel="stylesheet" >
<?php echo form_open_multipart('docs/store');?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h4 class="modal-title"><?php echo $title; ?></h4>
	</div>

	<div class="modal-body">
		<div class="form-group hidden">
			<input type="number" class="form-control" id="id" name="id" value="<?php echo isset($entity->id) ? $entity->id : 0; ?>">
		</div>

		<div class="form-group">
			<label for="file_name">Upload file</label>
			<input type="file" class="form-control" id="file_name" name="file_name" value="<?php echo isset($entity->file_name) ? $entity->file_name : ''; ?>" accept="all" required>
		</div>

		<div class="form-group">
			<label for="category_id">Document Category</label>
			<select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" >
				<option></option>
				<?php foreach($categories as $category): ?>
					<option value="<?php echo $category->id; ?>" <?php echo isset($entity->category_id) ? $category->id == $entity->category_id ? 'selected' : '' : ''; ?> ><?php echo $category->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="doc_name">Document Name</label>
			<input type="text" class="form-control" id="doc_name" name="doc_name" value="<?php echo isset($entity->doc_name) ? $entity->doc_name : ''; ?>" required>
		</div>

		<div class="form-group">
			<label for="file_size">File size</label>
			<input type="text" class="form-control" id="file_size" name="file_size" value="<?php echo isset($entity->file_size) ? $entity->file_size : ''; ?>" required readonly>
		</div>

		<div class="form-group">
			<label for="file_type">File type</label>
			<input type="text" class="form-control" id="file_type" name="file_type" value="<?php echo isset($entity->file_type) ? $entity->file_type : ''; ?>" required readonly>
		</div>

	</div>
	
	<div class="modal-footer">
		<div class="form-group">
			<button type="button" class="btn btn-flat btn-info pull-left" data-dismiss="modal">Close</button>
			<input type="submit" value="Submit" class="btn btn-flat btn-danger">
		</div>
	</div>
	
</form><!-- End Form -->
<script src="<?php echo base_url('resources/plugins/select/js/bootstrap-select.min.js');?>"></script>
<script src="<?php echo base_url('resources/js/lodash/lodash.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#category_id').selectpicker()
		
		$('#file_name').change(function() {
			$file = $(this)[0].files[0]
			
			$('#doc_name').val(_.chain($file.name).split('.', 1).startCase())
			$('#file_size').val(bytesToSize($file.size, 2))
			$('#file_type').val($file.type)
		});

		function bytesToSize(bytes, precision)
		{  
		    var kilobyte = 1024;
		    var megabyte = kilobyte * 1024;
		    var gigabyte = megabyte * 1024;
		    var terabyte = gigabyte * 1024;
		   
		    if ((bytes >= 0) && (bytes < kilobyte)) {
		        return bytes + ' B';
		 
		    } else if ((bytes >= kilobyte) && (bytes < megabyte)) {
		        return (bytes / kilobyte).toFixed(precision) + ' KB';
		 
		    } else if ((bytes >= megabyte) && (bytes < gigabyte)) {
		        return (bytes / megabyte).toFixed(precision) + ' MB';
		 
		    } else if ((bytes >= gigabyte) && (bytes < terabyte)) {
		        return (bytes / gigabyte).toFixed(precision) + ' GB';
		 
		    } else if (bytes >= terabyte) {
		        return (bytes / terabyte).toFixed(precision) + ' TB';
		 
		    } else {
		        return bytes + ' B';
		    }
		}

	});
</script>
					