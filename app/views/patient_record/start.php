<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Patient Record Form</h4>
			<a href="/PatientRecordController/skipForm/<?php echo $form_data->id?>?user_id=<?php echo $_GET['user_id']?>&record_id=<?php echo $_GET['record_id']?>" class="btn btn-danger btn-sm">Skip Form</a>

			<?php Flash::show()?>
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