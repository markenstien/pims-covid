<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Deployed Patients</h4>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<a href="#" class="btn btn-primary btn-sm" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Filter</a>

			<?php if( isset($_GET['filter']) ) :?>
				<a href="?" class="btn btn-warning btn-sm">Remove Filter</a>
			<?php endif?>
			<hr>
			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Deployment Filter</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
			      </div>
			      <div class="modal-body">
			      	<?php
			      		Form::open([
			      			'method' => 'get',
			      			'action' => ''
			      		]);
			      	?>

			      	<div class="form-group">
			      		<?php
			      			Form::label('Quarantine Type');
			      			Form::select('quarantine_type' , ['Hospital' , 'Home'] , '' , [
			      				'class' => 'form-control',
			      				'id' => 'id_quarantine_type'
			      			]);
			      		?>
			      	</div>

			      	<div class="form-group mt-2" id="id_hospital_container">
			      		<?php
			      			Form::label('Hospital');
			      			Form::select('hospital' , $hospitals , '' , [
			      				'class' => 'form-control',
			      			]);
			      		?>
			      	</div>

			      	<div class="form-group mt-2">
			      		<?php
			      			Form::submit('filter' , 'Apply Filter');
			      		?>
			      	</div>
			      	<?php Form::close();?>
			      </div>
			    </div>
			  </div>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Patient Name</th>
						<th>Hospital</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($results as $row) :?>
							<tr>
								<td><?php echo $row->last_name.', '.$row->first_name.$row->middle_name?></td>
								<td><?php echo $row->name ?? 'Home Quarantine'?></td>
								<td><?php echo $row->deployment_date?></td>
								<td><?php echo $row->release_remarks ?? 'waiting'?></td>
								<td>
									<?php echo btnView(_route('deployment:show' , $row->id) )?>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php build('scripts')?>
	<script type="text/javascript">
		$( document ).ready( function(e) 
		{
			$("#id_quarantine_type").change( function(e) 
			{
				let value = $(this).val();

				if( value != 'Hospital') {
					$('#id_hospital_container').hide();
				}else{
					$('#id_hospital_container').show();
				}
			});
		});
	</script>
<?php endbuild()?>
<?php loadTo()?>