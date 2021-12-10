<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Laboratory Results</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>

			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Reference</th>
						<th>Date Requested</th>
						<th>Date Reported</th>
						<th>Severity</th>
						<th>Patient Name</th>
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
								<td><?php echo $row->patient_name?></td>
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
<?php endbuild()?>
<?php loadTo()?>