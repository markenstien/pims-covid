<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Classification Criteria</h4>
			<?php echo btnCreate( _route('criteria:create') , 'Create' ) ?> 
			<a href="<?php echo _route('remarks:index') ?>" class="btn btn-primary btn-sm">Remarks</a>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>Label</th>
						<th>Compare</th>
						<th>Points</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($criterias as $row) :?>
							<tr>
								<td><?php echo $row->label?></td>
								<td><?php echo $row->compare_by ?></td>
								<td><?php echo $row->points?></td>
								<td>
									<?php
										__([
											btnEdit(_route('criteria:edit' , $row->id), 'Edit'),
											btnDelete(_route('criteria:delete' , $row->id), 'Delete'),
										]);
									?>
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