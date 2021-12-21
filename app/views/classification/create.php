<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Classification Form</h4>
		</div>

		<div class="card-body">
			<?php echo $classification_form->getForm()?>
		</div>
	</div>
<?php endbuild() ?>
<?php loadTo()?>