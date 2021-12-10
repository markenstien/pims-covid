<?php
	extract($data);

	$template = <<<EOF
		<p>
			{$lab_result->patient_name}, Good day! <br>
			The results on your laboratory test is ready,<br>
			Click the link to preview full details of your result
			<a href="{$public_link}">Show full Result</a>
		</p>
		<p>
			Summary : 
			Pathologist: $lab_result->pathologist <br>
			Medical Technologist: $lab_result->medical_technologist
			<br><br>
			Doctors Remarks : 
			{$lab_result->remarks} <br>
			Prepared By Doctor : {$lab_result->doctor_name}
		</p>
	EOF;
	
	return $template;
?>