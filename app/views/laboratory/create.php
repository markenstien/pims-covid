<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Laboratory Result Form</h4>
		</div>

		<div class="card-body">
			<?php echo $lab_form->start() ?>

			<?php
				__([
					$lab_form->get('doctor_id'),
					$lab_form->get('patient_id'),
					$lab_form->get('record_id'),
				]);

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
					<div class="col-md-3">
						<?php echo $lab_form->getCol('date_requested'); ?>
					</div>
					<div class="col-md-3">
						<?php echo $lab_form->getCol('date_reported'); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="section">
						<h5>Chest Extray</h5>
						<div class="form-group">
							<?php echo $lab_form->getRow('abnormalities')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getRow('densities')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getRow('pneumonia')?>
						</div>
					</div>

					<div class="section">
						<h5>Blood Count</h5>
						<div class="form-group">
							<?php echo $lab_form->getRow('rbc')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getRow('wbc')?>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="section">
						<h5>Urine</h5>
						<div class="form-group">
							<?php echo $lab_form->getRow('color')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getRow('clarity')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getCol('ketones')?>
						</div>
					</div>

					<div class="section">
						<h5>Stool</h5>
						<div class="form-group">
							<?php echo $lab_form->getRow('ova')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getRow('larva')?>
						</div>
					</div>

					<div class="section">
						<h5>Allergies</h5>
						<div class="form-group">
							<?php echo $lab_form->getRow('allergies')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getRow('meds')?>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="section">
						<h5>Remarks</h5>
						<?php echo $lab_form->getCol('remarks')?>
					</div>


					<div class="section">
						<h5>Pathologist And Medical Technologist</h5>
						<div class="form-group">
							<?php echo $lab_form->getCol('pathologist')?>
						</div>
						<div class="form-group">
							<?php echo $lab_form->getCol('medical_technologist')?>
						</div>
					</div>

					<?php echo $lab_form->get('submit')?>
				</div>
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