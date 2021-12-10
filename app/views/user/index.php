<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Users</h4>

			<?php echo btnCreate( _route('user:create') )?>
		</div>

		<div class="card-body">
			<?php Flash::show()?>

			<div class="table-responsive" style="min-height: 30vh;">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Reference</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Phone Number</th>
						<th>Type</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $users as $row) :?>
							<tr>
								<td><?php echo $row->user_code?></td>
								<td><?php echo $row->last_name . ' , ' .$row->first_name . ' '. $row->middle_name . ' ' ?></td>
								<td><?php echo $row->gender ?></td>
								<td><?php echo $row->phone_number ?></td>
								<td><?php echo $row->user_type ?></td>
								<td>
									<?php 
										$anchor_items = [
											[
												'url' => _route('user:show' , $row->id),
												'text' => 'View',
												'icon' => 'eye'
											],

											[
												'url' => _route('user:edit' , $row->id),
												'text' => 'Edit',
												'icon' => 'edit'
											],
											[
												'url' => _route('patient-record:create' , null , ['user_id' => $row->id]),
												'text' => 'add record',
												'icon' => 'plus'
											]
										
										];
									echo anchorList($anchor_items)?>
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