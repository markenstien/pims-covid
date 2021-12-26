<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Patient Records</h4>
			<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
			  Filter
			</button>
			<?php if( isset($_GET['filter']) ) :?>
				<a href="?" class="btn btn-secondary btn-sm">Clear Filter</a>
			<?php endif?>
		</div>

		<div class="card-body">
			<?php Flash::show()?>

			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>#</th>
						<th>Reference</th>
						<th>Name</th>
						<th>Date</th>
						<th>Doctors Approval</th>
						<th>Deployed</th>
						<th>Status</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($patient_records as $key => $row) : ?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->reference?></td>
								<td><?php echo $row->first_name , ' '. $row->last_name?></td>
								<td><?php echo $row->date?></td>
								<td><?php echo !is_null($row->doctors_approval) ? 'Approved' : 'For-Classification'?></td>
								<td><?php echo $row->is_deployed ? 'Patient Is Deployed' : 'Waiting For Deployment'?></td>
								<td><?php echo $row->report_status?></td>
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

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Filter Result</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
	      </div>
	      <div class="modal-body">
	      	<?php
	      		Form::open([
	      			'method' => 'GET'
	      		]);
	      	?>
	      	<div class="form-group mb-2">
	      		<?php
	      			Form::label('Deployed');
	      			Form::select('is_deployed' , ['1' => 'Deployed' , '0' => 'Waiting For Deployment'] , '' , ['class' => 'form-control']);
	      		?>
	      	</div>

	      	<div class="form-group mb-2">
	      		<?php
	      			Form::label('Status');
	      			Form::select('report_status' , ['completed','on-going','invalid','pending'] , '' , ['class' => 'form-control']);
	      		?>
	      	</div>

	      	<div class="row form-group mb-2">
	      		<div class="col">
	      			<?php
	      				Form::label('Start Date');
	      				Form::date('start_date' , '' , ['class' => 'form-control'])
	      			?>
	      		</div>
	      		<div class="col">
	      			<?php
	      				Form::label('End Date');
	      				Form::date('end_date' , '' , ['class' => 'form-control'])
	      			?>
	      		</div>
	      	</div>


	      	<div class="form-group mb-2">
	      		<?php Form::submit('filter' , 'Apply Filter')?>
	      	</div>
	      	<?php Form::close()?>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
<?php endbuild()?>
<?php loadTo()?>