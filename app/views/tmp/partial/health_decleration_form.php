<?php extract($data)?>
<div>
	<h2 class="text-center mb-4">Health Declaration Form</h2>
	<fieldset>
		<legend>Patient Details</legend>
		<table class="table table-bordered">
			<tr>
				<td>Full Name</td>
				<td><?php echo $user_data->first_name . ' '.$user_data->middle_name .' '. $user_data->last_name?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?php echo $user_data->address?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $user_data->email?></td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td><?php echo $user_data->phone_number?></td>
			</tr>
		</table>
	</fieldset>

	<?php divider()?>

	<?php echo $patient_form->start()?>
	<?php echo $patient_form->get('user_id')?>

	<?php 
		if( $patient_form->checkField('id') )
			echo $patient_form->get('id');
	?>
	
	<div class="col-md-5">
		<h4>Arrival</h4>
		<table class="table table-bordered">
			<tr><?php echo $patient_form->getCol('date')?></tr>
			<tr><?php echo $patient_form->getCol('time')?></tr>
		</table>
	</div>

	
	<div class="mt-3">
		<h4>Assesment</h4>
		<div>
			<p>Put a check mark on the appopriate column of your response(Lagyan ng tsek sa angkop na sagot)</p>
		</div>
		<?php divider()?>
		<div class="row align-items-center ">
			<div class="col-md-5">
				<p>Are you Experiencing or did you have any of the following 
						in the last 14 days (Ikaw ba ay may nararanasan o nakaranas ng mga sumusunod 
						na sintomas sa nakaraang 14 na araw?)</p>
			</div>

			<div class="col-md-7">
				<?php echo $patient_form->getCol('is_fever')?>
				<?php echo $patient_form->getCol('is_body_pains')?>
				<?php echo $patient_form->getCol('is_sore_throat')?>
				<?php echo $patient_form->getCol('is_headache')?>
				<?php echo $patient_form->getCol('is_diarrhea')?>
				<?php echo $patient_form->getCol('is_lost_of_taste_smell')?>
				<?php echo $patient_form->getCol('is_dificulty_breathing')?>
			</div>
		</div>
		<div><?php echo $patient_form->get('submit')?></div>
	</div>

	<?php echo $patient_form->end()?>
</div>