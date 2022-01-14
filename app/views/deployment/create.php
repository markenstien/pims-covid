<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><?php echo $page_title?></h4>
			<?php Flash::show()?>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-md-8">
					<h4>Deployment Form</h4>
					<?php echo $form->getForm()?>
				</div>

				<div class="col-md-4">
					<h4>Hospital Details</h4>

					<div id="hospital_data"></div>
				</div>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php build('scripts') ?>
	<script type="text/javascript">
		$( document ).ready( function (evt) 
		{

			$("#id_hospital").change( function() 
			{

				$("#hospital_data").html('');

				let hospital_data = '<ul>';

				let hospital_id = $(this).val();

				let url = getURL('api/hospital/get');

				$.ajax({
					url: url,
					data: {
						hospital_id: hospital_id
					},
					method: 'post',

					success : function(response) 
					{
						let extracted = JSON.parse(response);
						let hospital = extracted.hospital;

						hospital_data += `
							<li>${hospital.name}</li>
							<li>${hospital.phone}</li>
							<li>${hospital.email}</li>
							<li>${hospital.city}</li>
						`;

						hospital_data += '</ul>';

						$("#hospital_data").html(hospital_data);
					}
					
				});
			});
		});
	</script>
<?php endbuild()?>
<?php loadTo()?>