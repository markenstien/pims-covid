<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Laboratory Result Form</h4>
		</div>

		<div class="card-body">
			<?php echo $lab_form->start() ?>

			<?php
				__([
					$lab_form->get('id'),
					$lab_form->get('record_id')
				]);
				
				Form::hidden('classify_doc_id' , whoIs('id'));

				if( isset($_GET['request_id']))
					echo Form::hidden('request_id' , $_GET['request_id']);
			?>
			<div class="section">
				<div class="row">
					<div class="col-md-6">
						<label class="mt-3">Patient Name</label>
						<div class="form-control"><?php echo $record->last_name.',' .$record->first_name . ' '.$record->last_name?></div>
						<small>(#<?php echo $record->user_code?>)</small> <?php echo $record->gender?> <?php echo $record->age?>
					</div>
				</div>
			</div>

			<?php divider()?>


			<div class="form-group">
				<?php
					echo $lab_form->getCol('severity')
				?>
			</div>

			<div class="form-group">
				<?php
					echo $lab_form->getCol('notes')
				?>
			</div>

			<div>
				<?php echo $lab_form->get('submit');?>
			</div>


			<?php echo $lab_form->end() ?>
		</div>
	</div>
<?php endbuild()?>

<?php build('styles') ?>
	<style type="text/css">
		div.section {
			margin-bottom: 15px;
			background: #eee;
			padding: 10px;
		}
		div.section h5
		{
			margin-bottom: 10px;		
		}
	</style>
<?php endbuild()?>
<?php loadTo()?>