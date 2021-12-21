<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Classification</h4>

			<?php echo btnCreate( _route('classification-item:create' , null, [
				'classification_id' => $classification->id])  , 'Add Item')?>

			<a href="<?php echo _route('classification:duplicate' , $classification->id) ?>" 
				class="btn btn-warning btn-sm form-verify">
				Duplicate
			</a>
			<?php Flash::show()?>

		</div>

		<div class="card-body">
			<section>
				<table class="table table-bordered">
					<tr>
						<td>Reference</td>
						<td><?php echo $classification->reference?></td>
					</tr>
					<tr>
						<td>Classification</td>
						<td><?php echo $classification->name?></td>
					</tr>
					<tr>
						<td>Description</td>
						<td><?php echo $classification->description?></td>
					</tr>
				</table>
			</section>

			<?php divider()?>


			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>Label</th>
						<th>Compare</th>
						<th>Description</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($classification->items as $row) :?>
							<tr>
								<td><?php echo $row->label?></td>
								<td><?php echo $row->compare_by ?></td>
								<td><?php echo $row->description?></td>
								<td>
									<?php
										__([
											btnEdit(_route('classification-item:edit' , $row->id), 'Edit'),
											btnDelete(_route('classification-item:delete' , $row->id), 'Delete'),
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
<?php endbuild()?>
<?php loadTo()?>