<?php build('content')?>
	
	<div class="card">
		<?php Flash::show();?>

		<div class="card-header">
			<h4 class="card-title"><?php echo $page_title?></h4>
		</div>

		<div class="card-body">
			<div class="col-md-6">
				<table class="table table-bordered">
					<tr>
						<td style="width: 30%;">Name</td>
						<td><?php echo $hospital->name?></td>
					</tr>
					<tr>
						<td style="width: 30%;">Phone/Tel</td>
						<td><?php echo $hospital->phone?></td>
					</tr>
					<tr>
						<td style="width: 30%;">Website</td>
						<td><?php echo $hospital->website?></td>
					</tr>

					<tr>
						<td style="width: 30%;">Email</td>
						<td><?php echo $hospital->email ?></td>
					</tr>

					<tr>
						<td style="width: 30%;">Address</td>
						<td><?php echo $hospital->address->complete_address ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Deployed Patients</h4>
		</div>

		<div class="card-body">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Reference</th>
					<th>Patient Name</th>
					<th>Remarks</th>
					<th>Address</th>
					<th>Action</th>
				</thead>

				<tbody>
					<?php foreach($deployments as $key => $row) :?>
						<tr>
							<td><?php echo ++$key?></td>
							<td><?php echo $row->reference?></td>
							<td><?php echo $row->last_name.',' .$row->first_name . ' '.$row->middle_name?></td>
							<td><?php echo empty($row->release_remarks) ? 'on-going':$row->release_remarks ?></td>
							<td><?php echo $row->address?></td>
							<td><?php echo btnView( _route('deployment:show' , $row->id) )?></td>
						</tr>
					<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo()?>