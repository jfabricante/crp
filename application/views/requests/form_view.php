<link href="<?php echo base_url('resources/plugins/select2/css/select2.min.css');?>" rel="stylesheet" >
<form action="<?php echo base_url('index.php/request/store'); ?>" method="post">
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
			<label for="purpose">Purpose</label>
			<input type="text" class="form-control" id="purpose" name="purpose" value="<?php echo isset($entity->purpose) ? $entity->purpose : ''; ?>" required>
		</div>

		<div class="form-group">
			<label for="justification">Justification</label>
			<input type="text" class="form-control" id="justification" name="justification" value="<?php echo isset($entity->justification) ? $entity->justification : ''; ?>" required>
		</div>

		<div class="form-group">
			<label for="doc_id">Requested Document</label>
			<select name="doc_id" id="doc_id" class="form-control select2" data-live-search="true" >
				<option></option>
				<?php foreach($documents as $document): ?>
					<option value="<?php echo $document->id; ?>" <?php echo isset($entity->doc_id) ? $document->id == $entity->doc_id ? 'selected' : '' : ''; ?> ><?php echo $document->doc_name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="permission">Permission</label>
			<select name="permission" id="permission" class="form-control select2" data-live-search="true" >
				<option></option>
				<?php foreach($permissions as $permission): ?>
					<option value="<?php echo $permission; ?>" <?php echo isset($entity->permission) ? $permission == $entity->permission ? 'selected' : '' : ''; ?> ><?php echo ucfirst($permission)?></option>
				<?php endforeach; ?>
			</select>
		</div>

	</div>
	
	<div class="modal-footer">
		<div class="form-group">
			<button type="button" class="btn btn-flat btn-info pull-left" data-dismiss="modal">Close</button>
			<input type="submit" value="Submit" class="btn btn-flat btn-danger">
		</div>
	</div>
	
</form><!-- End Form -->
<script src="<?php echo base_url('resources/plugins/select2/js/select2.min.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#doc_id').select2();
		$('#permission').select2();
	});
</script>