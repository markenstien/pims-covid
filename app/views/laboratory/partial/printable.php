<!DOCTYPE html>
<html>
<head>
	<style>
		@media print{
			@page{
				size: 8.5in 7in;
			}
		}
		#print{
			border:2px solid #000;
			overflow:hidden;
			width:850px;
			min-height:550px;
			margin:auto;
		}
	</style>
</head> 
<body> 
<button onclick="printContent('print')">Print Content</button>
<button><a style = "text-decoration:none; color:#000;" href = "<?php echo _route('lab:show' , $lab_result->id)?>" class = "btn btn-info"><span class = "glyphicon glyphicon-print">Back</a></button>
<br />
<br />
	<div id="print">
		<div style = "margin:10px;">
			<center><label>COVID-19 Baranggay Triage</label></center>
			<center><label style = "font-size:12px;">Baranggay Culiat</label></center>
			<br />
			<br />
			<div style = "margin-left:50px;" >
				<label>Name:
				<?php echo "<u>".$record->last_name.",".$record->first_name.' '.$record->middle_name."</u>";?>
				</label>
				<label style = "margin-left:20px;" >Date of Request:
				<?php echo "<u>".$lab_result->date_requested."</u>";?>
				</label>
				<br />
				<br />
				<label>Address:
						<?php  echo "<u>".$record->address."</u>";?>
				</label>
				<label style = "margin-left:20px;" >Age:
						<?php echo $record->age?>
				</label>
				<label style = "margin-left:20px;" >Sex:
						<?php echo $record->gender?>
				</label>
				<br />
				<br />
				<label>Requested By:<?php echo $lab_result->doctor_name?></label>
				<br />
			</div>
				<center><h2>LABORATORY</h2></center>
			<div style = "float:left; width:40%; margin-left:40px;">
				<label style = "font-size:16px;"><b><u>CHEST X-RAY</u></b></label>
				<br />
				<label style = "margin-left:50px;">Abnormalities:
					<?php echo "<u>".$lab_result->abnormalities."</u>";?>
				</label>
				<br />
				<label style = "margin-left:50px;">Densities:<?php echo "<u>".$lab_result->densities."</u>";?></label>
				<br />
				<label style = "font-size:16px;"><b><u>BLOOD COUNT</u></b></label>
				<br />
				<label style = "margin-left:50px;">RBC:<?php echo "<u>".$lab_result->rbc."</u>";?></label>
				<br />
				<label style = "margin-left:50px;">WBC:<?php echo "<u>".$lab_result->wbc."</u>";?></label>
				<br />
				<label style = "font-size:16px;"><b><u>REMARKS:</u></b></label>
				<br />
				<label style = "word-wrap:break-word;">	
					<?php echo "<u>".$lab_result->remarks."</u>";?>
				</label>
			</div>
			<div style = "float:left; margin-left:90px; width:40%;">
				<label style = "font-size:16px;margin-left:30px;"><b><u>URINE</u></b></label>
				<br />
				<label style = "margin-left:50px;">Color:<?php echo "<u>".$lab_result->color."</u>";?></label>
				<br />
				<label style = "margin-left:50px;">Clarity:<?php echo "<u>".$lab_result->clarity."</u>";?></label>
				<br />
				<label style = "margin-left:50px;">Ketones:<?php echo "<u>".$lab_result->ketones."</u>";?></label>
				<br />
				<label style = "font-weight:bold; text-decoration:underline; margin-left:30px;">STOOL
				</label>
				<br />
				<label style = "margin-left:50px;">Ova:<?php echo "<u>".$lab_result->ova."</u>";?></label>
				<br />
				<label style = "margin-left:50px;">larva:<?php echo "<u>".$lab_result->larva."</u>";?></label>
				<br />
				<label style = "margin-left:50px;">Severity:<?php echo "<u>".$lab_result->severity."</u>";?></label>
				<br />
				<label style = "font-weight:bold; text-decoration:underline; margin-left:30px;">ALLERGIES</label>
				<p><?php echo $lab_result->allergies ?? ''?></p>
				<br />
				<label style = "margin-left:50px;">Medicines:<?php echo "<u>".$lab_result->meds."</u>";?></label>
				<br />
				
				</label>
				<br />
				<label><b>Date Reported:</b><?php echo "<u>".$lab_result->date_reported."</u>";?></label>
			</div>
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br>
			<br>
			<label style = "border-top:1px solid #000; margin-left:40px; float:left;"><center>
				<?php echo "<u>".$lab_result->pathologist."</u>";?></center>
			<label><center><b>Pathologist</b></center></label></label>
			
			<label style = "float:right; margin-top:-15px; margin-right:70px;"><center>
				<?php echo "<u>".$lab_result->medical_technologist."</u>";?>,RMT</center>
			<label><center><b>MEDICAL TECHNOLOGIST</b></center></label></label>
		</div>
	</div>
<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
	}
</script>
</html>