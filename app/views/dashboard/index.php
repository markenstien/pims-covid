<?php build('content')?>
	
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4>Patients</h4>
				</div>
				<div class="card-body">
					<?php
						$male_percentage = $summary['user']['gender']['male_percentage'];
						$female_percentage = $summary['user']['gender']['female_percentage'];
					?>
					<div class="progress" style="height: 30px;">
					  <div class="progress-bar" role="progressbar" 
					  style="width: <?php echo $male_percentage?>%" aria-valuenow="<?php echo $male_percentage?>" aria-valuemin="0" aria-valuemax="100">Male :<?php echo $male_percentage?>%</div>
					</div>
					<div class="progress" style="height: 30px;">
					  <div class="progress-bar bg-danger" role="progressbar" 
					  style="width:<?php echo $female_percentage?>%" aria-valuenow="<?php echo $female_percentage?>" aria-valuemin="0" aria-valuemax="100">Female : <?php echo $female_percentage?>%</div>
					</div>

					<hr>
					<section>
						<h6 class="card-title text-center">Age Group</h6>
                		<canvas id="id_age_group"></canvas>
					</section>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card mb-2">
				<div class="card-header">
					<h4>Severity</h4>
				</div>
				<div class="card-body">
					<canvas id="id_severity"></canvas>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h4>Deployment</h4>
				</div>
				<div class="card-body">
					<?php foreach( $summary['deployment'] as $key => $row) :?>
						<div class="progress" style="height: 30px;">
						  <div class="progress-bar bg-primary" role="progressbar" 
						  style="width:<?php echo $row?>%" aria-valuenow="<?php echo $row?>" aria-valuemin="0" aria-valuemax="100"><?php echo $key?> : <?php echo $row?>%</div>
						</div>
					<?php endforeach?>
				</div>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php build('scripts')?>
	<script src="<?php echo _path_tmp('assets/vendors/chartjs/Chart.min.js')?>"></script>
	<script src="<?php echo _path_tmp('assets/js/chartjs-light.js')?>"></script>
	<script type="text/javascript">
		<?php
			$age_group = array_filter($summary['user']['age_group']);
			$lab_summary = array_filter($summary['lab']);
		?>
		$( document ).ready( function(e) 
		{
			var age_groups = [<?php echo implode(',',$age_group)?>];
			var age_groups_labels = ['<?php echo implode("','" , array_keys($age_group))?>'];

			var lab_summaries = [ <?php echo implode(',' , array_values($lab_summary) )?> ];
			var lab_summary_key= [' <?php echo implode("','" , array_keys($lab_summary) )?> '];

			 var colors = {
			    primary        : "#6571ff",
			    secondary      : "#7987a1",
			    success        : "#05a34a",
			    info           : "#66d1d1",
			    warning        : "#fbbc06",
			    danger         : "#ff3366",
			    light          : "#e9ecef",
			    dark           : "#060c17",
			    muted          : "#7987a1",
			    gridBorder     : "rgba(77, 138, 240, .15)",
			    bodyColor      : "#000",
			    cardBg         : "#fff"
			  }

			  var fontFamily = "'Roboto', Helvetica, sans-serif"
			 	new Chart($('#id_age_group'), {
			      type: 'doughnut',
			      data: {
			        labels: age_groups_labels,
			        datasets: [
			          {
			            label: "Patient Age Groups",
			            backgroundColor: [colors.primary, colors.danger, colors.info],
			            borderColor: colors.cardBg,
			            data: age_groups,
			          }
			        ]
			      },
			      options: {
			        aspectRatio: 2,
			        plugins: {
			          legend: { 
			            display: true,
			            labels: {
			              color: colors.bodyColor,
			              font: {
			                size: '13px',
			                family: fontFamily
			              }
			            }
			          },
			        }
			      }
			    });

			    var fontFamily = "'Roboto', Helvetica, sans-serif"
			 	new Chart($('#id_severity'), {
			      type: 'doughnut',
			      data: {
			        labels: lab_summary_key,
			        datasets: [
			          {
			            label: "Patient Age Groups",
			            backgroundColor: [colors.primary, colors.danger, colors.info],
			            borderColor: colors.cardBg,
			            data: lab_summaries,
			          }
			        ]
			      },
			      options: {
			        aspectRatio: 2,
			        plugins: {
			          legend: { 
			            display: true,
			            labels: {
			              color: colors.bodyColor,
			              font: {
			                size: '13px',
			                family: fontFamily
			              }
			            }
			          },
			        }
			      }
			    });
		});
	</script>

<?php endbuild()?>

<?php loadTo()?>