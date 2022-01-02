<?php 
	use Form\LaboratoryRequestForm;

	load(['LaboratoryRequestForm'] , APPROOT.DS.'form');

	class LaboratoryRequestController extends Controller
	{

		public function __construct()
		{
			parent::__construct();
			
			$this->data['lab_req_form'] = new LaboratoryRequestForm();

			$this->model = model('LaboratoryRequestModel');
			$this->lab_model = model('LaboratoryModel');

			$this->patient_record = model('PatientRecordModel');
		}

		public function index()
		{
			$this->data['page_title'] = 'Laboratory Requests';
			$this->data['laboratory_results'] = $this->model->getAll(['order' => 'lab_req.id desc']);
			$this->data['is_admin'] = $this->is_admin;

			return $this->view('laboratory_request/index' , $this->data);
		}

		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post);

				if(!$res) {
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set( $this->model->getMessageString() );
				return redirect( _route('patient-record:show' , $post['record_id']) );
			}


			$record_id = request()->input('record_id');

			if(!$record_id)
				return $this->view('laboratory_request/how_to');

			$this->data['record'] = $this->patient_record->getComplete($record_id);

			$this->data['lab_req_form']->setValue('record_id' , $record_id);
			$this->data['lab_req_form']->setValue('created_by' , whoIs('id'));
			$this->data['lab_req_form']->setValue('patient_id' , $this->data['record']->user_id);

			return $this->view('laboratory_request/create' , $this->data);
		}

		public function show( $id )
		{
			$this->data['lab_result'] = $this->model->get($id);
			$this->data['lab'] = $this->lab_model->single([
				'record_id' => $this->data['lab_result']->record_id
			] , '*' , 'id desc');

			return $this->view('laboratory_request/show' , $this->data);
		}
	}