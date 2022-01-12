<?php build('content') ?>
	<?php Flash::show()?>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">User Preview</h4>
					<a href="<?php echo _route('user:edit' , $user->id)?>">Edit</a>
				</div>

				<div class="card-body">
					<h4>Personal Information</h4>
					<div>
						<img src="<?php echo $user->profile?>" style="width: 150px;">
					</div>
					<div>
						<label class="tx-11">Reference</label>
						<p><?php echo $user->user_code?></p>
					</div>

					<div>
						<label class="tx-11">User Type</label>
						<p><?php echo $user->user_type?> <?php if( $user->license_number) :?> <small>License Number(<?php echo $user->license_number?>)</small> <?php endif?></p>					
					</div>

					<div>
						<label class="tx-11">Name</label>
						<p><?php echo $user->last_name . ',' . $user->first_name . ' '.$user->middle_name?></p>
					</div>
					<div>
						<label class="tx-11">Gender</label>
						<p><?php echo $user->gender?></p>
					</div>
					<div>
						<label class="tx-11">Birth date</label>
						<p><?php echo $user->birthdate?></p>
					</div>
					<div>
						<label class="tx-11">Age</label>
						<p><?php echo $user->age?></p>
					</div>
					<hr>
					<div>
						<label class="tx-11">Email And Mobile Number</label>
						<p><?php echo $user->email?></p>
						<p><?php echo $user->phone_number?></p>
					</div>
					<?php if($user->address_object) :?>
						<div>
							<label class="tx-11">Address</label>
							<p><?php
								$address = $user->address_object;
								echo "{$address->block_house_number} {$address->street} {$address->city} {$address->barangay} {$address->zip}";
							?></p>
						</div>
					<?php else:?>
						<div>
							<p>Edit to add address details</p>
						</div>
					<?php endif?>
					<hr>
					<?php if( $is_admin && !isEqual($user->user_type , 'admin') ) :?>
						<div>
							<h4 class="bg-danger">Danger Zone</h4>
							<hr>
							<a href="<?php echo _route('user:delete' , $user->id , [
								'route' => seal( _route('user:index') )
							])?>" class="btn btn-danger btn-sm form-verify"> Delete User </a>
						</div>
					<?php endif?>
				</div>
			</div>	
		</div>

		<?php if( isEqual($user->user_type , ['patient'])) :?>
			<div class="col-md-8">
				<?php if( ! is_null($number_of_days_remaining) ) :?>
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">UNDER HOME QUARANTINE</h4>
						</div>

						<div class="card-body">
							Number Of days Remaining <strong> <?php echo $number_of_days_remaining?> </strong> Before Quarantine Completion.
							Under Quarantine for Approx (<strong><?php echo $number_of_days_after_deployment ?></strong>)

							<div>
								<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Send Email</a>
							</div>
						</div>
					</div>
				<?php endif?>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Laboratory Results</h4>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered dataTable">
								<thead>
									<th>Reference</th>
									<th>Date Requested</th>
									<th>Date Reported</th>
									<th>Severity</th>
									<th>Requested By</th>
									<th>Action</th>
								</thead>

								<tbody>
									<?php foreach($laboratory_results as $row) : ?>
										<tr>
											<td><?php echo $row->reference?></td>
											<td><?php echo $row->date_requested?></td>
											<td><?php echo $row->date_reported?></td>
											<td><?php echo $row->severity?></td>
											<td><?php echo $row->doctor_name?></td>
											<td>
												<?php echo btnView(_route('lab:show' , $row->id),'View')?>
											</td>
										</tr>
									<?php endforeach?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		<?php endif?>
	</div>


	<!-- SEND LAB RESULT TO EMAIL -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">EMAIL ABOUT QUARANTINE STATUS</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
	      </div>
	      <div class="modal-body">
	      	<form method="post" action="<?php echo _route('mailer:send')?>">

	      		<input type="hidden" name="route" value="<?php echo seal( _route('user:show' , $user->id) ) ?>">
	      		<h5 class="mb-2">Send To Email</h5>


	      		<input type="hidden" name="lab_id" value="<?php echo $lab_result->id?>">

	      		<div class="form-group">
	      			<label>Subject</label>
	      			<?php Form::textarea('subject' , " Hey !".$user->first_name, ['class' => 'form-control' , 
	      			'rows' => 1 , 'placeholder' => $user->first_name . ', Enter Motivating Subject'])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>


	      		<div class="form-group">
	      			<label>Email</label>
	      			<?php Form::textarea('recipients' , $user->email , ['class' => 'form-control' , 
	      			'rows' => 1 , 'placeholder' => 'eg.'.$user->email])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>

	      		<div class="form-group">
	      			<label>Additional Notes</label>
	      			<?php
	      				$message = "Good day ".$user->first_name .',';
	      				$message .= ' '.COMPANY_NAME . ' Would like to extend our support to your quarantine';
	      				$message .= " We are also emailing you to update you that you are ".$number_of_days_remaining ." days away before completing your quarantine";
	      			?>
	      			<?php Form::textarea('body' , $message , ['class' => 'form-control' , 
	      			'rows' => 3 , 'placeholder' => 'some-text' ])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>

	      		<input type="submit" name="" class="btn btn-primary" value="Send">
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- -->
<?php endbuild()?>
<?php loadTo()?>