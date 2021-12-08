<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Patient Record</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<?php grab('tmp/partial/health_decleration_form' , [
				'patient_form' => $patient_record_form,
				'user_data'    => $user
			])?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>