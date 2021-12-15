<?php build('content')?>
	
	<div class="card">
		<?php Flash::show();?>

		<div class="card-header">
			<h4 class="card-title"><?php echo $page_title?></h4>
		</div>

		<div class="card-body">
			<div class="col-md-6">
				<table class="table table-bordered">
					<tr>
						<td style="width: 30%;">Name</td>
						<td><?php echo $hospital->name?></td>
					</tr>
					<tr>
						<td style="width: 30%;">Phone/Tel</td>
						<td><?php echo $hospital->phone?></td>
					</tr>
					<tr>
						<td style="width: 30%;">Website</td>
						<td><?php echo $hospital->website?></td>
					</tr>

					<tr>
						<td style="width: 30%;">Email</td>
						<td><?php echo $hospital->email ?></td>
					</tr>

					<tr>
						<td style="width: 30%;">Address</td>
						<td><?php echo $hospital->address->complete_address ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo()?>