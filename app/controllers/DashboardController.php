<?php 

	class DashboardController extends Controller
	{
		public function __construct()
		{
			$this->user_model = model('UserModel');
			$this->lab_model = model('LaboratoryModel');
			$this->deployment_model = model('DeployModel');
		}

		public function index()
		{
			$this->data['page_title'] = 'Dashboard';
			
			$user_summary = $this->user_model->getSummary();
			$lab_summary = $this->lab_model->getSummary();
			$deployment = $this->deployment_model->getSummary();

			$this->data['page_title'] = 'Dashboard';
			$this->data['summary'] = [
				'user' => $user_summary,
				'lab' => $lab_summary,
				'deployment' => $deployment
			];

			if( isEqual( whoIs('user_type') , 'patient') ){
				//recent
				$deployment = $this->deployment_model->getRecent( whoIs('id') );

				$number_of_days_after_deployment = null;
				$number_of_days_remaining = null;
				
				if($deployment)
				{
					$number_of_days_after_deployment = date_difference( $deployment->deployment_date, date('Y-m-d'));
					$number_of_days_remaining = abs(( abs($number_of_days_after_deployment) - 14));
				}
				
				$this->data['deployment_date'] = $deployment->deployment_date;
				$this->data['number_of_days_remaining'] = $number_of_days_remaining;
				$this->data['number_of_days_after_deployment'] = $number_of_days_after_deployment;
				$this->data['finish_quarantine_date'] =  date('Y-m-d', strtotime($deployment->deployment_date. ' + 14 days'));

				
				return $this->view('dashboard/patient_index' , $this->data);
			}

			return $this->view('dashboard/index' , $this->data);
		}
	}