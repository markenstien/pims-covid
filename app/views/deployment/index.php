<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Deployed Patients</h4>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Patient Name</th>
						<th>Hospital</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($results as $row) :?>
							<tr>
								<td><?php echo $row->last_name.', '.$row->first_name.$row->middle_name?></td>
								<td><?php echo $row->name?></td>
								<td><?php echo $row->deployment_date?></td>
								<td><?php echo $row->record_status?></td>
								<td>
									<?php echo btnView(_route('deployment:show' , $row->id) )?>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>