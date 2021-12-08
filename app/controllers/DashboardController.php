<?php 

	class DashboardController extends Controller
	{
		public function index()
		{
			$this->data['page_title'] = 'Dashboard';
			
			return $this->view('dashboard/index' , $this->data);
		}
	}