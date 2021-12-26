<?php build('content') ?>
	
	<div class="card">
		<div class="card-body">
			<h5 class="mb-2">Classificators</h5>
			<?php Form::open(['method' => 'post' , 'action' => '']); ?>
				<input type="hidden" name="record_id" value="<?php echo $record_id?>">
				<?php foreach($classificators as $key => $row) : ?>
					<div class="form-group mb-2">
						<?php
							Form::label($row->label);
							Form::hidden("items[$key][id]" , $row->id);
							Form::hidden("items[$key][label]" , $row->label);

							Form::text("items[$key][value]" , '' , [
								'class' => 'form-control'
							]);
							Form::small( $row->description );
						?>
					</div>
				<?php endforeach?>

				<?php Form::submit('' , 'Save')?>
			<?php Form::close()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>