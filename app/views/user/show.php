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
						<p><?php echo $user->user_type?></p>
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
					<div>
						<label class="tx-11">Address</label>
						<p><?php
							$address = $user->address_object;
							echo "{$address->block_house_number} {$address->street} {$address->city} {$address->barangay} {$address->zip}";
						?></p>
					</div>
				</div>
			</div>	
		</div>

		<?php if( isEqual($user->user_type , ['patient'])) :?>
			<div class="col-md-8">
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
<?php endbuild()?>
<?php loadTo()?>