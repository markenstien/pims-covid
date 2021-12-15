<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Hospitals</h4>
			<?php echo btnCreate( _route('hospital:create') )?>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Address</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $hospitals as $key => $row) : ?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->name?></td>
								<td><?php echo $row->address->barangay ?? 'N/A'?></td>
								<td>
									<?php echo btnView(_route('hospital:show' , $row->id) )?>
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