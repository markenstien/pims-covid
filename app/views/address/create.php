<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Address</h4>
		</div>

		<div class="card-body"><?php echo $address_form->getForm()?></div>
	</div>
<?php endbuild()?>

<?php loadTo()?>