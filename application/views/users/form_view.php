<link href="<?php echo base_url('resources/plugins/select2/css/select2.min.css');?>" rel="stylesheet" >
<?php echo form_open_multipart('user/store');?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h4 class="modal-title"><?php echo $title; ?></h4>
	</div>

	<div class="modal-body">
		<div class="form-group hidden">
			<input type="text" class="form-control" id="id" name="id" value="<?php echo isset($entity->id) ? $entity->id : 0; ?>" />

		</div>

		<!-- username -->
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" class="form-control" id="username" name="username" value="<?php echo isset($entity->username) ? $entity->username : ''; ?>" required autofocus />
		</div>
		<!-- ./username -->

		<!-- password -->
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" value="<?php echo isset($entity->password) ? $entity->password : ''; ?>" required autofocus />
		</div>
		<!-- ./password -->

		<!-- employee no -->
		<div class="form-group">
			<label for="emp_no">Employee No.</label>
			<input type="emp_no" class="form-control" id="emp_no" name="emp_no" value="<?php echo isset($entity->emp_no) ? $entity->emp_no : ''; ?>" required autofocus />
		</div>
		<!-- ./employee no -->

		<!-- fullname -->
		<div class="form-group">
			<label for="fullname">Fullname</label>
			<input type="fullname" class="form-control" id="fullname" name="fullname" value="<?php echo isset($entity->fullname) ? $entity->fullname : ''; ?>" required autofocus />
		</div>
		<!-- ./fullname -->

		<!-- email address -->
		<div class="form-group">
			<label for="email">Email Address</label>
			<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($entity->email) ? $entity->email : ''; ?>" required autofocus />
		</div>
		<!-- ./email -->

		<div class="form-group">
			<label for="role_id">User type</label>
			<select name="role_id" id="role_id" class="form-control select2" data-live-search="true" >
				<option></option>
				<?php foreach($roles as $role): ?>
					<option value="<?php echo $role->id; ?>" <?php echo isset($entity->role_id) ? $role->id == $entity->role_id ? 'selected' : '' : ''; ?> ><?php echo $role->user_type; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="position_id">Position</label>
			<select name="position_id" id="position_id" class="form-control select2" >
				<option></option>
				<?php foreach($positions as $position): ?>
					<option value="<?php echo $position->id; ?>" <?php echo isset($entity->position_id) ? $entity->position_id == $position->id ? 'selected' : '' : ''; ?> ><?php echo $position->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="branch_id">Dealer</label>
			<select name="branch_id" id="branch_id" class="form-control select2" data-live-search="true" >
				<option></option>
				<?php foreach($branches as $branch): ?>
					<option value="<?php echo $branch->id; ?>" <?php echo isset($entity->position_id) ? $branch->id == $entity->branch_id ? 'selected' : '' : ''; ?> ><?php echo $branch->name; ?></option>
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
<!-- End of table -->
<script src="<?php echo base_url('resources/plugins/select2/js/select2.min.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('select').select2({});
	});
</script>