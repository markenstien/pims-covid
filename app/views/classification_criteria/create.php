<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Criteria Create Form</h4>
			<a href="<?php echo _route('criteria:index') ?>">Back</a>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $form->getForm()?>
		</div>
	</div>
<?php endbuild() ?>

<?php build('scripts') ?>
	<script type="text/javascript" src="<?php echo _path_public('js/classification/item.js')?>"></script>
<?php endbuild()?>
<?php loadTo()?>