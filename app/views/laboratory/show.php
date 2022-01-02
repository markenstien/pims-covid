<?php build('content') ?>
	<?php Flash::show()?>
	<div class="card">
		<div class="card-header">
			<h4 class="text-center"> LAB RESULT </h4>
			<div class="row">
				<div class="col">
					<h5>#<?php echo $lab_result->reference?></h5>
				</div>
				<div class="col" style="text-align: right;">
					<h5>Date Requested : <?php echo $lab_result->date_requested?></h5>
					<h5>Date Reported : <?php echo $lab_result->date_reported?></h5>
				</div>
			</div>
			<?php divider()?>
			<div class="text-center">
				<h4><?php echo $lab_result->patient_name?></h4>
				<p>(<?php echo '#'.$lab_result->patient_code?>)</p>
			</div>

			<dl>
				<dt>Contact</dt>
				<dd><?php echo $patient->phone_number?></dd>
				<dt>Email</dt>
				<dd><?php echo $patient->email?></dd>
				<dt>Address</dt>
				<dd><?php echo $patient->address?></dd>
			</dl>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-7">
					<h4 class="mb-2">Patient</h4>
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>Name</label>
								<div class="form-control"><?php echo $lab_result->patient_name?></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Gender</label>
								<div class="form-control"><?php echo $patient->gender ?? 'N/A'?></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Age</label>
								<div class="form-control"><?php echo $patient->age ?? 'N/A'?></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Birth Date</label>
								<div class="form-control"><?php echo $patient->birthdate ?? 'N/A'?></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<h4 class="mb-2">Requested By</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Name</label>
								<div class="form-control"><?php echo $lab_result->doctor_name?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<!-- LAB RESULT -->
			<?php divider()?>

			<div class="row">
				<div class="col-md-6">
					<div class="section">
						<h5>Chest Extray</h5>
						<table class="table table-bordered table-sm">
							<tr>
								<td><?php echo $lab_form->label('abnormalities')?></td>
								<td><?php echo $lab_form->label('densities')?></td>
								<td><?php echo $lab_form->label('pneumonia')?></td>
							</tr>
							<tr>
								<td><?php echo $lab_result->abnormalities?></td>
								<td><?php echo $lab_result->densities?></td>
								<td><?php echo $lab_result->pneumonia?></td>
							</tr>
						</table>
					</div>
					
					<div class="section">
						<h5>Blood Count</h5>
						<table class="table table-bordered table-sm">
							<tr>
								<td><?php echo $lab_form->label('rbc')?></td>
								<td><?php echo $lab_form->label('wbc')?></td>
							</tr>
							<tr>
								<td><?php echo $lab_result->rbc?></td>
								<td><?php echo $lab_result->wbc?></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="col-md-6">
					<div class="section">
						<h5>Urine</h5>
						<div class="table-responsive">
							<table class="table table-bordered table-sm">
								<tr>
									<td><?php echo $lab_form->label('color')?></td>
									<td><?php echo $lab_form->label('clarity')?></td>
									<td><?php echo $lab_form->label('ketones')?></td>
								</tr>
								<tr>
									<td><?php echo $lab_result->color?></td>
									<td><?php echo $lab_result->clarity?></td>
									<td><?php echo $lab_result->ketones?></td>
								</tr>
							</table>
						</div>
					</div>

					<div class="section">
						<h5>Stool</h5>

						<table class="table table-bordered table-sm">
							<tr>
								<td><?php echo $lab_form->label('ova')?></td>
								<td><?php echo $lab_form->label('larva')?></td>
							</tr>
							<tr>
								<td><?php echo $lab_result->ova?></td>
								<td><?php echo $lab_result->larva?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="section">
						<h5>Remarks</h5>
						<?php echo $lab_result->remarks ?>
					</div>
					<div class="section">
						<strong>Severity : <?php echo $lab_result->severity?></strong>
						<hr>
						<?php if(!empty($lab_result->notes)) :?>
							<h5>Doctors Notes</h5>
							<p><?php echo $lab_result->notes?></p>
						<?php endif?>
					</div>
				</div>
				
				<div class="col-md-6">

					<div class="section">
						<h5>Allergies</h5>
						<p><?php echo $lab_result->allergies?></p>
						<br>
						<h5>Medicines</h5>
						<p><?php echo $lab_result->meds?></p>
					</div>

					<?php divider()?>
					<div class="row">
						<div class="col">
							<?php echo $lab_result->pathologist ?>
							<h6>Pathologist</h6>
						</div>

						<div class="col">
							<?php echo $lab_result->medical_technologist ?>
							<h6>Medical Technologist</h6>
						</div>
					</div>
				</div>
			</div>
			<!--// -->
		</div>

		<div class="card-footer">
			<a href="<?php echo $public_link.'&prepare_print=true'?>">Prepare For Printing</a> |


			<?php if( !isEqual( whoIs('user_type') , 'patient') ):?>
				<?php echo anchor( _route('lab:edit' , $lab_result->id)  , 'edit' , ' Edit Result ')?> |
			<?php endif?>

			<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Share</a> |

			<?php echo anchor( _route('patient-record:show' , $lab_result->record_id)  , 'view' , 'Show Report ')?>

			<hr>
			<?php if(!$lab_result->classify_doc_id) :?>
				<div>
					<?php if( isEqual(whoIs('user_type') , ['doctor' , 'admin']) ) :?>
						<a href="<?php echo _route('lab:classify' , $lab_result->id)?>"
							class="btn btn-primary btn-lg">Classify</a>
					<?php endif?>
				</div>
			<?php else:?>
				<p>Lab Result Already Everified by: <?php echo $lab_result->doctor_name?>
					<?php echo anchor( _route('user:show' , $lab_result->classify_doc_id) ,'view' , 'View Doctor' )?>
				</p>
			<?php endif?>
		</div>

		<div class="card-footer">
			<h4 class="card-title">Danger Zone</h4>

			<?php if($is_admin) :?>
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('lab:delete' , $lab_result->id , [
							'route' => seal( _route('lab:index') )
						])
					]);
				?>
				<?php Form::submit('' , 'Delete' , ['class' => 'btn btn-danger form-verify'])?>

				<?php Form::close()?>
			<?php endif?>
		</div>
	</div>
	
	<!-- SEND LAB RESULT TO EMAIL -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">SHARE LABORATORY RESULT</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
	      </div>
	      <div class="modal-body">
	      	<form method="post" action="<?php echo _route('lab:send-to-mail' , $lab_result->id)?>">
	      		<h5 class="mb-2">Send To Email</h5>


	      		<input type="hidden" name="lab_id" value="<?php echo $lab_result->id?>">

	      		<div class="form-group">
	      			<label>Subject</label>
	      			<?php Form::textarea('subject' , $patient->first_name . ' '.'Your Lab Result is ready' , ['class' => 'form-control' , 
	      			'rows' => 1 , 'placeholder' => $patient->first_name . ', Your Lab Result is ready'])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>


	      		<div class="form-group">
	      			<label>Email</label>
	      			<?php Form::textarea('recipients' , $patient->email , ['class' => 'form-control' , 
	      			'rows' => 1 , 'placeholder' => 'eg.'.$patient->email])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>

	      		<div class="form-group">
	      			<label>Additional Notes</label>
	      			<?php Form::textarea('body' , '', ['class' => 'form-control' , 
	      			'rows' => 3 , 'placeholder' => 'some-text' ])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>

	      		<input type="submit" name="" class="btn btn-primary" value="Send">
	      	</form>
	      	<hr>
	      	<?php divider()?>

	      	<input type="text" name="" value="<?php echo $public_link?>" data-copy="<?php echo $public_link?>"
	      		class="form-control">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- -->
<?php endbuild()?>

<?php build('styles') ?>
	<style type="text/css">
		div.section {
			margin: 20px 0px;
		}
	</style>
<?php endbuild()?>
<?php loadTo()?>