<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><?php echo $page_title?></h4>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $form->getForm()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>