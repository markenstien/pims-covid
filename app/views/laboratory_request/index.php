<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Laboratory Requests</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>

			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>#</th>
						<th>Reference</th>
						<th>Date Requested</th>
						<th>Status</th>
						<th>Patient Name</th>
						<th>Requested By</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($laboratory_results as $key => $row) : ?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->reference?></td>
								<td><?php echo $row->date_requested?></td>
								<td><?php echo $row->status?></td>
								<td><?php echo $row->patient_name?></td>
								<td><?php echo $row->doctor_name?></td>
								<td>
									<?php echo btnView(_route('lab-request:show' , $row->id),'View')?>
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