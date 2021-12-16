<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Patient Deployment Record</h4>
			<label>#<?php echo $deployment->reference?></label>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h5>Patient</h5>
					<p><?php echo $record->last_name.','.$record->first_name . ' '.$record->middle_name?> </p>

					<ul>
						<li>Gender: <?php echo $record->gender?></li>
						<li>Age: <?php echo $record->age?></li>
						<li>Birthdate: <?php echo $record->birthdate?></li>
						<li><?php echo anchor(_route('user:show' , $record->user_id) ,  'view' , 'Show patient') ?></li>
					</ul>
				</div>

				<div class="col-md-6">
					<h5>Deployment</h5>
					<?php if( !$deployment->hospital_id ) :?>
						<h5>Hostial Name : Children hospital</h5>
					<?php else:?>
						<ul>
							<li>Date Released : <?php echo $deployment->deployment_date?></li>
							<li>Quarantine Type : Hospitalized </li>
							<li>Hospital Name: <?php echo anchor(_route('hospital:show' , $hospital->id) , 'view' , $hospital->name)?> </li>
							<li style="margin-top: 7px;">Status : <?php echo $deployment->record_status?></li>
							<li>Release Remarks : <?php echo $deployment->release_remarks?></li>
						</ul>
					<?php endif?>

					<h5>Deployed By</h5>
					<p><?php echo $deployment->deployed_by_user->last_name.','.$deployment->deployed_by_user->first_name .' '.$deployment->deployed_by_user->middle_name?></p>
				</div>
			</div>


			<div class="row">
				<div class="col-md-6">
					<h5>Deployment Notes</h5>
					<?php echo $deployment->notes?>
					<h5 class="mt-3">Health Declaration and Lab-Results</h5>
					<ul>
						<li><?php echo $patient_record_form->label('is_fever')?> : 
							<?php echo bool_convert($record->is_fever)?></li>
						<li><?php echo $patient_record_form->label('is_body_pains')?> : 
							<?php echo bool_convert($record->is_body_pains)?></li>
						<li><?php echo $patient_record_form->label('is_sore_throat')?> : 
							<?php echo bool_convert($record->is_sore_throat)?></li>
						<li><?php echo $patient_record_form->label('is_headache')?> : 
							<?php echo bool_convert($record->is_headache)?></li>
						<li><?php echo $patient_record_form->label('is_diarrhea')?> : 
							<?php echo bool_convert($record->is_diarrhea)?></li>
						<li><?php echo $patient_record_form->label('is_lost_of_taste_smell')?> : 
							<?php echo bool_convert($record->is_lost_of_taste_smell)?></li>
						<li><?php echo $patient_record_form->label('is_dificulty_breathing')?> : 
							<?php echo bool_convert($record->is_dificulty_breathing)?></li>
					</ul>

					<?php foreach($record->lab_results as $row) :?>
						Lab Result:  <?php echo anchor(_route('lab:show' , $row->id) , 'view' , "#{$row->reference}")?>
					<?php endforeach?>
				</div>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>