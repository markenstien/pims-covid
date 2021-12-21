<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Classification Remark Form</h4>
			<a href="<?php echo _route('remarks:index') ?>">Back</a>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $form->getForm()?>
		</div>
	</div>
<?php endbuild() ?>
<?php loadTo()?>