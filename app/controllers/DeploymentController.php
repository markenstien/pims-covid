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

			return $this->view('deployment/show' , $this->data);
		}
	}