<?php build('content') ?>
	<?php Flash::show()?>
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
						<li class="mb-2"><?php echo anchor(_route('user:show' , $record->user_id) ,  'view' , 'Show patient') ?></li>

						<li><?php echo anchor(_route('patient-record:show' , $record->id) , 'view' , 'Report Record')?></li>
					</ul>
				</div>

				<div class="col-md-6">
					<h5>Deployment</h5>
					<?php if( !$deployment->hospital_id ) :?>
						<p>Home Quarantine</p>
					<?php else:?>
						<ul>
							<li>Date Released : <?php echo $deployment->deployment_date?></li>
							<li>Quarantine Type : Hospitalized </li>
							<li>Hospital Name: <?php echo anchor(_route('hospital:show' , $hospital->id) , 'view' , $hospital->name)?> </li>
							<li style="margin-top: 7px;">Status : <?php echo $deployment->record_status?></li>
							<li>Release Remarks : <?php echo $deployment->release_remarks?></li>
						</ul>
					<?php endif?>

					<h5 class="mt-2">Deployed By</h5>
					<p><?php echo $deployment->deployed_by_user->last_name.','.$deployment->deployed_by_user->first_name .' '.$deployment->deployed_by_user->middle_name?></p>

					<?php if($deployment->is_released) :?>
						<p class="mt-2">
							Release Status : <strong>Released</strong> <br>
							<?php echo $deployment->release_remarks?>
						</p>
					<?php else:?>

					<?php endif?>
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

					<?php if(!$deployment->is_released) :?>
						<hr>
						<h5>Release</h5>
						<?php
							Form::open([
								'method' => 'post',
								'action' => _route('deployment:release')
							]);

							Form::hidden('id' , $deployment->id);
						?>

						<div class="form-group">
							<?php
								echo $form->getRow('release_remarks');
							?>
						</div>

						<div class="form-group">
							<?php echo $form->get('submit')?>
						</div>

						<?php Form::close()?>
					<?php endif?>
				</div>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>