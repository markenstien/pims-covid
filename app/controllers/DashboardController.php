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

			return $this->view('dashboard/index' , $this->data);
		}
	}