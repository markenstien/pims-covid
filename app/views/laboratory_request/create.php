<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Laboratory Request Form</h4>
		</div>

		<div class="card-body">
			<?php echo $lab_req_form->start() ?>
			<?php __([ $lab_req_form->get('created_by') , $lab_req_form->get('record_id') , $lab_req_form->get('patient_id') ])?>
				<div class="section">
					<div class="row">
						<div class="col-md-7">
							<label class="mt-3">Patient Name</label>
							<div class="form-control"><?php echo $record->last_name.',' .$record->first_name . ' '.$record->last_name?></div>
							<small>(#<?php echo $record->user_code?>)</small> <?php echo $record->gender?> <?php echo $record->age?>
						</div>
						<div class="col-md-5">
							<?php $lab_req_form->setValue('date_requested' , date('Y-m-d'))?>
							<?php echo $lab_req_form->getCol('date_requested'); ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<?php echo $lab_req_form->getCol('notes');?>
				</div>

				<div class="form-group mt-2">
					<?php echo $lab_req_form->get('submit');?>
				</div>
			<?php echo $lab_req_form->end() ?>
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