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

<?php build('scripts') ?>
	<script>
		$( document ).ready( function( evt ) {
			$("#id_license_number").parent().parent().hide();

			$("#id_user_type").change( function(evt) {

				if( $(this).val() == 'doctor' ) {
					$("#id_license_number").parent().parent().show();
				}else{
					$("#id_license_number").parent().parent().hide();
				}
			});
		});
	</script>
<?php endbuild()?>
<?php loadTo()?>