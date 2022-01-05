<?php 

	class ReportController extends Controller
	{

		public function __construct()
		{
			
		}

		public function create()
		{	
			$request_params = request()->inputs();

			

			if( !empty($request_params) )
			{
				$start_date = $request_params['start_date'];
				$end_date = $request_params['end_date'];

				if( empty($start_date) || empty($end_date) )
				{
					Flash::set("Start date and End date must not be empty" , 'danger');
					return request()->return();
				}
				$ret_val = [
					'total_miled_cases' => 0,
					'total_moderate_cases' => 0,
					'total_severe_cases' => 0,
					'total_deployed_cases' => 0,
					'total_record'   => 0,

					'recovered_cases' => 0,
					'total_death'  => 0,
					'number_of_hospital_quarantine' => 0,
					'number_of_home_quarantine' => 0,
				];

				$patient_record_model = model('PatientRecordModel');

				$deploy_model = model('DeployModel');

				$db = Database::getInstance();

				$db->query(
					"SELECT * FROM laboratory_results
						WHERE date_requested between '{$start_date}' and '{$end_date}' "
				);

				$laboratories = $db->resultSet();

				foreach($laboratories as $lab) {

					if( isEqual($lab->severity , 'mild') )
						$ret_val['total_miled_cases']++;

					if( isEqual($lab->severity , 'moderate') )
						$ret_val['total_moderate_cases']++;

					if( isEqual($lab->severity , 'severe') )
						$ret_val['total_severe_cases']++;
				}

				$records = $patient_record_model->getAll([
					'date' => [
						'condition' => 'between',
						'value'     => [$start_date , $end_date]
					]
				]);

				$deployments = $deploy_model->getAll();

				foreach($deployments as $key => $row) 
				{
					if( isEqual($row->release_remarks , 'recovered') ){
						$ret_val['recovered_cases']++;
					}else if( isEqual($row->release_remarks, 'deceased')) {
						$ret_val['total_death']++;
					}


					if( !is_null($row->hospital_id) ){
						$ret_val['number_of_hospital_quarantine']++;
					}else{
						$ret_val['number_of_home_quarantine']++;
					}
				}

				if($deployments)
					$ret_val['total_deployed_cases'] = count($deployments);

				if($records)
					$ret_val['total_record'] = count($records);

				$this->data['items'] = [
					'laboratories' => $laboratories,
					'records' => $records,
					'deployments' => $deployments,
					'summary' => $ret_val
				];
			}

			$this->data['title'] = 'Report';

			return $this->view('report/create' , $this->data);
		}
	}