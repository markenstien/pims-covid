<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Create User</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<?php echo $user_form->start()?>
			<?php echo $user_form->getFormItems()?>
			<?php echo $address_form->getFormItems()?>
				<input type="submit" name="" class="btn btn-primary btn-sm" value="Create User">
			<?php echo $user_form->end()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>