<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Classification Remark Form</h4>
			<?php echo btnCreate(_route('remarks:create'), 'Create')?>
			<?php echo btnCreate(_route('criteria:index'), 'Classifications')?>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<table class="table table-bordered">
				<thead>
					<th>#</th>
					<th>Remarks</th>
					<th>Points</th>
					<th>Color</th>
				</thead>

				<tbody>
					<?php foreach( $remarks as $key => $row) :?>
						<tr>
							<td><?php echo ++$key?></td>
							<td><?php echo $row->remarks?></td>
							<td><?php echo $row->points?></td>
							<td>
								<span class="badge bg-<?php echo $row->color?>">Color</span>
							</td>
						</tr>
					<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
<?php endbuild() ?>

<?php build('scripts') ?>
	<script type="text/javascript" src="<?php echo _path_public('js/classification/item.js')?>"></script>
<?php endbuild()?>
<?php loadTo()?>