<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Classifications</h4>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Reference</th>
						<th>Name</th>
						<th>Severity</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $classifications as $key => $row) : ?>
							<tr>
								<td><?php echo ++$key?> </td>
								<td><?php echo $row->reference?></td>
								<td><?php echo $row->name?></td>
								<td><?php echo $row->severity_name?></td>
								<td>
									<?php echo btnView(_route('classification:show' , $row->id))?>
								</td>
							</tr>
						<?php endforeach?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild() ?>
<?php loadTo()?>