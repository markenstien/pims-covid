<?php 
	use Form\DeployForm;
	use Form\PatientForm;
	
	load(['DeployForm' , 'PatientForm'] , APPROOT.DS.'form');

	class DeploymentController extends Controller
	{

		public function __construct()
		{
			$this->data['form'] = new DeployForm();
			$this->model = model('DeployModel');
			$this->form_patient_respondent_model = model('RecordFormRespondentsModel');
		}

		public function index()
		{
			$this->data['results'] = $this->model->getAll([
				'order' => 'deploy.id desc'
			]);
			$this->data['page_title'] = ' Deployed Patients ';

			return $this->view('deployment/index' , $this->data);

		}

		public function create( $record_id )
		{	
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post);
				if($res) {
					Flash::set( $this->model->getMessageString());
				}else{
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				return redirect(_route('deployment:show' , $res));
			}

			$type = request()->input('type');

			$this->data['page_title'] = 'Home Quarantine';
			$this->data['type'] = $type;
			$this->data['form']->addRecordId($record_id);
			$this->data['form']->remove('release_remarks');

			if( isEqual($type , 'home-quarantine') ){
				$this->data['form']->remove('hospital_id');
				$this->data['page_title'] = 'Home Quarantine';
			}

			if( isEqual($type, 'hospital') )
				$this->data['page_title'] = 'Hospital Deployment';

			return $this->view('deployment/create' , $this->data);
		}

		public function show($id)
		{
			$deployment = $this->model->getComplete($id);

			$this->data['deployment'] = $deployment;
			$this->data['page_title'] = " Patient Deployment : #{$deployment->reference} ";
			$this->data['record'] = $deployment->record;
			$this->data['hospital'] = $deployment->hospital;
			$this->data['patient_record_form'] = new PatientForm();

			$this->data['form_patient_respondents'] = $this->form_patient_respondent_model->getByRecord( $deployment->record->id ); 

			return $this->view('deployment/show' , $this->data);
		}

		public function release()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->release($post , $post['id']);

				if($res) {
					Flash::set("Patient Deployment Released");
					return request()->return();
				}
			}
		}
	}