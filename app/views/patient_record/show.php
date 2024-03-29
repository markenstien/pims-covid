<?php build('content') ?>
	<?php Flash::show()?>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col">
					<h5>#<?php echo $record->reference?></h5>
				</div>
				<div class="col" style="text-align: right;">
					<h5>Date : <?php echo $record->date?></h5>
				</div>
			</div>
			<?php divider()?>
			<div class="text-center">
				<h4><?php echo $record->last_name .',' . $record->first_name . ' '.$record->middle_name?></h4>
				<p>(<?php echo '#'.$record->user_code?>)</p>
			</div>

			<dl>
				<dt>Contact</dt>
				<dd><?php echo $record->phone_number?></dd>
				<dt>Email</dt>
				<dd><?php echo $record->email?></dd>
				<dt>Address</dt>
				<dd><?php echo $record->address?></dd>
			</dl>

			<details>
				<summary class="text-danger">Page Contents</summary>
				<ul>
					<li><a href="#id-lab-result">Lab Results</a></li>
					<li><a href="#id-page-actions">Actions</a></li>
				</ul>
			</details>
		</div>
		<div class="card-body">

			<div class="row">
				<div class="col-md-6">
					<h4>Personal</h4>
					<table class="table table-bordered table-sm">
						<tr>
							<td>First Name: </td>
							<td><?php echo $record->first_name?></td>
						</tr>
						<tr>
							<td>Middle Name: </td>
							<td><?php echo $record->middle_name?></td>
						</tr>
						<tr>
							<td>Last Name: </td>
							<td><?php echo $record->last_name?></td>
						</tr>
						<tr>
							<td>Birth Date: </td>
							<td><?php echo $record->birthdate?></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><?php echo $record->gender?></td>
						</tr>
					</table>
					<?php divider()?>
				</div>

				<div class="col-md-6">
					<h4>Record Updates & Files</h4>
					<table class="table table-bordered">
						<tr>
							<td>Record Status:</td>
							<td><?php echo $record->report_status?></td>
						</tr>
						<tr>
							<td>Completion Status:</td>
							<td><?php echo $record->completion_status ?? 'N/A'?></td>
						</tr>
						<tr>
							<td>Is Deployed:</td>
							<td><?php echo bool_convert($record->is_deployed)?></td>
						</tr>
					</table>
				</div>
			</div>

			<?php if( $record->forms ) :?>
				<?php divider()?>
				<div class="row">
					<?php foreach( $record->forms as $key => $row) :?>
						<div class="col-md-6">
							<h4><?php echo $row->form_data->title?></h4>
							<small><?php echo $row->form_data->description?></small>
							<ul>
								<?php foreach( $row->form_items as $item_key => $item_row) : ?>
									<li><?php echo $item_row->name?> : <?php echo $item_row->answer?></li>
								<?php endforeach?>
							</ul>
						</div>
					<?php endforeach?>
				</div>
			<?php endif?>

			<?php if( $record->classification) :?>
				<h4>Patient Classification</h4>
				<ul>
					<?php foreach( $record->classification->items as $key => $item ) :?>
						<li><?php echo $item->label?>  : <?php echo $item->value?></li>
					<?php endforeach?>
				</ul>
			<?php endif?>
		</div>

		<div class="card-footer" id="id-lab-result">
			<?php if( !isEqual(whoIs('user_type') , 'patient')) :?>
				<h4>Lab Results</h4>
				<?php
					if( !$record->lab_requests)
						echo anchor(_route('lab-request:create' ,null, ['record_id' => $record->id]) , 'custom' , 'Request Laboratory Result')
				?>
				<?php divider()?>
			<?php endif?>

			<?php if( $record->lab_requests && !isEqual(whoIs('user_type') , 'patient')) :?>
				<h5>Requests</h5>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>Refence</th>
							<th>Date Requested</th>
							<th>Doctor</th>
							<th>Status</th>
							<th>Submitted On</th>
							<th>Action</th>
						</thead>

						<tbody>
							<?php foreach( $record->lab_requests as $row) : ?>
								<tr>
									<td><?php echo $row->reference?></td>
									<td><?php echo $row->date_requested?></td>
									<td><?php echo $row->doctor_name?></td>
									<td><?php echo $row->status?></td>
									<td><?php echo $row->created_at?></td>
									<td><?php echo btnView( _route('lab-request:show' , $row->id)  , 'Show')?></td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			<?php else:?>
				<p>No Pending Lab result request</p>
			<?php endif?>

			<?php divider()?>
			<?php if( $record->lab_requests ) :?>
				<h5>Results</h5>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>Refence</th>
							<th>Date Requested</th>
							<th>Date Reported</th>
							<th>Doctor</th>
							<th>Remarks</th>
							<th>Action</th>
						</thead>

						<tbody>
							<?php foreach( $record->lab_results as $row) : ?>
								<tr>
									<td><?php echo $row->reference?></td>
									<td><?php echo $row->date_requested?></td>
									<td><?php echo $row->date_reported?></td>
									<td><?php echo $row->doctor_name?></td>
									<td><?php echo $row->remarks?></td>
									<td>
										<?php echo btnView( _route('lab:show' , $row->id)  , 'Show')?>
									</td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			<?php else:?>
				<p>No Pending Lab result request</p>
			<?php endif?>
		</div>

		<?php if( $is_admin ) :?>
			<div class="card-footer" id="id-page-actions">
				<h4>Actions</h4>
				<?php if( !$record->is_deployed) :?>
					<details>
						<summary class="text-danger">Deployment</summary>
						<ul>
							<li><a href="<?php echo _route('deployment:create' , $record->id, [
								'type' => 'home-quarantine'
							])?>">Home Quarantine</a></li>
							<li><a href="<?php echo _route('deployment:create' , $record->id, [
								'type' => 'hospital'
							])?>">Hospitalize</a></li>
						</ul>
					</details>
				<?php else:?>
					<p>Already Deployed : <?php echo anchor( _route('deployment:show' , $record->deployment->id) , 'view' , 'View Deployment')?> </p>
				<?php endif?>
				<br>
				<a href="<?php echo _route('patient-record:complete' , $record->id) ?>" class="btn btn-primary btn-sm form-verify"> Complete Record </a>
			</div>
		<?php endif?>

		<?php if( $is_admin) :?>
			<div class="card-footer" id="id-page-actions">
				<h4>Action</h4>
					<?php
						Form::open([
							'method' => 'post',
							'url'  => _route('patient-record:delete' , $record->id , [
								'route' => seal( _route('patient-record:index') )
							])
						]);

						Form::submit('' , 'Delete' , ['class' => 'btn btn-danger btn-sm form-verify']);

						Form::close();
					?>
			</div>
		<?php endif?>
	</div>

	<hr>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Patient files</h4>

			<?php echo btnCreate('#' , 'Add Files' , [
				'data-bs-toggle' => 'modal',
				'data-bs-target' => '#exampleModal'
			])?>
		</div>

		<?php if($patient_files) :?>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>#</th>
							<th>File Name</th>
							<th>Type</th>
							<th>Description</th>
							<th>Action</th>
						</thead>

						<tbody>
							<?php foreach($patient_files as $key => $row) :?>
								<tr>
									<td><?php echo ++$key?></td>
									<td><?php echo $row->filename?></td>
									<td><?php echo $row->file_type?></td>
									<td><?php echo $row->description?></td>
									<td>
										<a href="/ViewerController/show/?file=<?php echo urlencode($row->full_url)?>" class="btn btn-primary btn-sm"> Show </a>
											&nbsp;

										<a href="<?php echo _download_wrap($row->filename , $row->path) ?>" class="btn btn-primary btn-sm"> Download </a>
											&nbsp;

										<a href="<?php echo _route('attachment:delete' , $row->id) ?>" class="btn btn-danger btn-sm">Delete</a>
									</td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif?>
	</div>

	<!-- SEND LAB RESULT TO EMAIL -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">File Upload Form</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
	      </div>
	      <div class="modal-body">
	      	<?php echo $attachment_form->getForm()?>
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