<?php build('content') ?>
	
	<div class="col-md-7 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"> Laboratory Request </h4>
			</div>

			<div class="card-body">
				<h5>Date Requested : <?php echo $lab_result->date_requested?></h5>
				<small><?php echo $lab_result->status?></small>
				<table class="table table-bordered">
					<tr>
						<td>Requested By</td>
						<td><?php echo $lab_result->doctor_name?></td>
					</tr>
					<tr>
						<td>Patient Name</td>
						<td><?php echo $lab_result->patient_name?><small> (<?php echo $lab_result->patient_code?>) </small> </td>
					</tr>
					<tr>
						<td>Record Info</td>
						<td>
							<a href="<?php echo _route('patient-record:show' , $lab_result->record_id)?>">Show</a>
						</td>
					</tr>
				</table>

				<?php if( isEqual($lab_result->status , 'pending')) :?>
					<div class="mt-3"><a href="<?php echo _route('lab:create' , null , ['record_id' => $lab_result->record_id , 'request_id' => $lab_result->id])?>" class="btn btn-primary btn-lg">Create Lab Result</a></div>

				<?php else:?>
					<div class="mt-3"><a href="<?php echo _route('lab:show' ,  $lab_result->record_id )?>" class="btn btn-primary btn-lg">Show Lab Result</a></div>
				<?php endif?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>