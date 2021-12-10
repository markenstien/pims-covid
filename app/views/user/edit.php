<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit</h4>
			<a href="<?php echo _route('user:show' , $id)?>">Back</a>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<?php echo $user_form->getForm()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>