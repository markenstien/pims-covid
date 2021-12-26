<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Patient Record Form</h4>
			<a href="/PatientRecordController/skipForm/<?php echo $form_data->id?>" class="btn btn-danger btn-sm">Skip Form</a>
		</div>

		<div class="card-body">
			<?php grab('tmp/partial/form_builder_respond' , [
				'form_data' => $form_data,
				'form'      => $form
			])?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>