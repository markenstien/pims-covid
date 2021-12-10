<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Patient Records</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>

			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Reference</th>
						<th>Name</th>
						<th>Date</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($patient_records as $row) : ?>
							<tr>
								<td><?php echo $row->reference?></td>
								<td><?php echo $row->first_name , ' '. $row->last_name?></td>
								<td><?php echo $row->date?></td>
								<td>
									<?php echo btnView(_route('patient-record:show' , $row->id),'View')?>
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