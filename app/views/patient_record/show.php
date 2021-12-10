<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col">
					<h5>#<?php echo $record->reference?></h5>
				</div>
				<div class="col" style="text-align: right;">
					<h5>Date : <?php echo $record->date?></h5>
				</div>
			</div>
			<?php divider()?>
			<div class="text-center">
				<h4><?php echo $record->last_name .',' . $record->first_name . ' '.$record->middle_name?></h4>
				<p>(<?php echo '#'.$record->user_code?>)</p>
			</div>

			<dl>
				<dt>Contact</dt>
				<dd><?php echo $record->phone_number?></dd>
				<dt>Email</dt>
				<dd><?php echo $record->email?></dd>
				<dt>Address</dt>
				<dd><?php echo $record->address?></dd>
			</dl>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<h4>Personal</h4>
					<table class="table table-bordered table-sm">
						<tr>
							<td>First Name: </td>
							<td><?php echo $record->first_name?></td>
						</tr>
						<tr>
							<td>Middle Name: </td>
							<td><?php echo $record->middle_name?></td>
						</tr>
						<tr>
							<td>Last Name: </td>
							<td><?php echo $record->last_name?></td>
						</tr>
						<tr>
							<td>Birth Date: </td>
							<td><?php echo $record->birthdate?></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><?php echo $record->gender?></td>
						</tr>
					</table>
				</div>

				<div class="col-md-4">
					<h4>Physical Examination</h4>
					<table class="table table-bordered table-sm">
						<tr>
							<td>Oxygen Level </td>
							<td><?php echo $record->oxygen_level_num?>%</td>
						</tr>
						<tr>
							<td>Blood Pressure: </td>
							<td><?php echo $record->blood_presure_num?></td>
						</tr>
						<tr>
							<td>Temperature </td>
							<td><?php echo $record->temperature_num?></td>
						</tr>
						<tr>
							<td>Pulse Rate: </td>
							<td><?php echo $record->pulse_rate_num?></td>
						</tr>
						<tr>
							<td>Respiratory Rate: </td>
							<td><?php echo $record->respirator_rate_num?></td>
						</tr>
						<tr>
							<td>Height</td>
							<td><?php echo $record->height_num?>CM</td>
						</tr>
						<tr>
							<td>Weight</td>
							<td><?php echo $record->weight_num?>Kg</td>
						</tr>
					</table>
				</div>

				<div class="col-md-4">
					<h4>Health Decleration</h4>
					<table class="table table-bordered table-sm">
						<tr>
							<td><?php echo $patient_record_form->label('is_fever')?></td>
							<td><?php echo bool_convert('is_fever')?></td>
						</tr>
						<tr>
							<td><?php echo $patient_record_form->label('is_body_pains')?></td>
							<td><?php echo bool_convert('is_body_pains')?></td>
						</tr>
						<tr>
							<td><?php echo $patient_record_form->label('is_sore_throat')?></td>
							<td><?php echo bool_convert('is_sore_throat')?></td>
						</tr>
						<tr>
							<td><?php echo $patient_record_form->label('is_headache')?></td>
							<td><?php echo bool_convert('is_headache')?></td>
						</tr>
						<tr>
							<td><?php echo $patient_record_form->label('is_diarrhea')?></td>
							<td><?php echo bool_convert('is_diarrhea')?></td>
						</tr>
						<tr>
							<td><?php echo $patient_record_form->label('is_lost_of_taste_smell')?></td>
							<td><?php echo bool_convert('is_lost_of_taste_smell')?></td>
						</tr>
						<tr>
							<td><?php echo $patient_record_form->label('is_dificulty_breathing')?></td>
							<td><?php echo bool_convert('is_dificulty_breathing')?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<?php if( !isEqual(whoIs('user_type') , 'patient')) :?>
				<h4>Lab Results</h4>
				<?php echo anchor(_route('lab-request:create' ,null, ['record_id' => $record->id]) , 'custom' , 'Request Laboratory Result')?>
				<?php divider()?>
			<?php endif?>

			<?php if( $record->lab_requests && !isEqual(whoIs('user_type') , 'patient')) :?>
				<h5>Requests</h5>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>Refence</th>
							<th>Date Requested</th>
							<th>Doctor</th>
							<th>Status</th>
							<th>Submitted On</th>
							<th>Action</th>
						</thead>

						<tbody>
							<?php foreach( $record->lab_requests as $row) : ?>
								<tr>
									<td><?php echo $row->reference?></td>
									<td><?php echo $row->date_requested?></td>
									<td><?php echo $row->doctor_name?></td>
									<td><?php echo $row->status?></td>
									<td><?php echo $row->created_at?></td>
									<td><?php echo btnView( _route('lab-request:show' , $row->id)  , 'Show')?></td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			<?php else:?>
				<p>No Pending Lab result request</p>
			<?php endif?>

			<?php divider()?>
			<?php if( $record->lab_requests ) :?>
				<h5>Results</h5>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>Refence</th>
							<th>Date Requested</th>
							<th>Date Reported</th>
							<th>Doctor</th>
							<th>Remarks</th>
							<th>Action</th>
						</thead>

						<tbody>
							<?php foreach( $record->lab_results as $row) : ?>
								<tr>
									<td><?php echo $row->reference?></td>
									<td><?php echo $row->date_requested?></td>
									<td><?php echo $row->date_reported?></td>
									<td><?php echo $row->doctor_name?></td>
									<td><?php echo $row->remarks?></td>
									<td>
										<?php echo btnView( _route('lab:show' , $row->id)  , 'Show')?>
									</td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			<?php else:?>
				<p>No Pending Lab result request</p>
			<?php endif?>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo()?>