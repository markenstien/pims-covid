<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Hospital Patient Deployment</h4>
			<label>For Severe and special Covid Cases</label>
		</div>

		<div class="card-body">
			<?php echo $form->getForm()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>