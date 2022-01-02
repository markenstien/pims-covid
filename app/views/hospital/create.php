<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><?php echo $page_title?></h4>
			<?php if( isset($hospital_id)) :?>
				<a href="<?php echo _route('hospital:show' , $hospital_id)?>">Back</a>
			<?php endif?>
		</div>

		<div class="card-body">
			<?php echo $form->getForm()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>