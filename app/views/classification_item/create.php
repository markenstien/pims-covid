<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Classification Form</h4>
			<a href="<?php echo _route('classification:show' , $classification_id) ?>">Back</a>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<?php echo $classification_item_form->getForm()?>
		</div>
	</div>
<?php endbuild() ?>

<?php build('scripts') ?>
	<script type="text/javascript" src="<?php echo _path_public('js/classification/item.js')?>"></script>
<?php endbuild()?>
<?php loadTo()?>