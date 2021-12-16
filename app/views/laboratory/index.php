<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Laboratory Results</h4>
			<!-- Button trigger modal -->
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
						<th>Reference</th>
						<th>Date Requested</th>
						<th>Date Reported</th>
						<th>Severity</th>
						<th>Patient Name</th>
						<th>Requested By</th>
						<th>Category</th>
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
								<td><?php echo !is_null($row->classify_doc_id) ? 'Approved' : 'For Classification'?></td>
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
	      			Form::label('Severity');
	      			Form::select('severity' , ['mild' , 'moderate' , 'severe'] , '' , ['class' => 'form-control']);
	      		?>
	      	</div>

	      	<div class="form-group mb-2">
	      		<?php
	      			Form::label('Category');
	      			Form::select('category' , ['For-Classification' , 'Approved'] , '' , ['class' => 'form-control']);
	      		?>
	      	</div>

	      	<div class="form-group mb-2">
	      		<?php
	      			Form::label('Doctor');
	      			Form::select('doctor_id' , $doctors , '' , ['class' => 'form-control']);
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