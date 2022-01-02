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
					<li>Date Released : <?php echo $deployment->deployment_date?></li>
					<?php if( !$deployment->hospital_id ) :?>
						<p>Home Quarantine</p>
					<?php else:?>
						<ul>
							<li>Quarantine Type : Hospitalized </li>
							<li>Hospital Name: <?php echo anchor(_route('hospital:show' , $hospital->id) , 'view' , $hospital->name)?> </li>
							<li style="margin-top: 7px;">Status : <?php echo $deployment->record_status?></li>
						</ul>
					<?php endif?>

					Release Remarks : <?php echo $deployment->release_remarks?>
					<h5 class="mt-2">Deployed By</h5>
					<p><?php echo $deployment->deployed_by_user->last_name.','.$deployment->deployed_by_user->first_name .' '.$deployment->deployed_by_user->middle_name?></p>

					<?php if($deployment->is_released) :?>
						<p class="mt-2">
							Released Status : <strong><?php echo $deployment->is_released ? 'Released' : 'Waiting'?></strong> <br>
						</p>
					<?php else:?>

					<?php endif?>
				</div>
			</div>


			<div class="row">
				<div class="col-md-6">
					<h5>Deployment Notes</h5>
					<?php echo $deployment->notes?>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<?php foreach( $form_patient_respondents as $key => $row) :?>
								<div>
									<h4><?php echo $row->form_data->title?></h4>
									<p><?php echo $row->form_data->description?></p>

									<section>
										<ul>
											<?php foreach($row->form_items as $item_key => $item_row) : ?>
												<li>
													<?php echo $item_row->name?> : <?php echo $item_row->answer?>
												</li>
											<?php endforeach?>
										</ul>
									</section>
								</div>
							<?php endforeach?>
						</div>
					</div>
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

		<div class="card-footer">
			<?php if( $is_admin) :?>
				<h4>Danger Zone</h4>
				<a href="<?php echo _route('deployment:delete' , $deployment->id , [
					'route' => seal( _route('deployment:index') )
				])?>" class="btn btn-danger btn-sm form-verify">Delete</a>
			<?php endif?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>