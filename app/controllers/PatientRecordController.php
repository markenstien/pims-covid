<?php 
	
	use Form\PatientForm;
	load(['PatientForm'] , APPROOT.DS.'form');

	class PatientRecordController extends Controller
	{	

		public function __construct()
		{
			parent::__construct();

			$this->data['page_title'] = 'Patient Record';

			$this->data['patient_record_form'] = new PatientForm();

			$this->model = model('PatientRecordModel');
			$this->user_model = model('UserModel');
			$this->classification_model = model('ClassificationModel');

			$this->data['whoIs'] = whoIs();
		}

		public function index()
		{
			$patient_records = $this->model->getAll();

			$request_params = request()->inputs();
			
			if( isEqual($this->data['whoIs']->user_type , 'patient') )
			{
				$patient_records = $this->model->getAll([
					'where' => [
						'user_id' => $this->data['whoIs']->id
					]
				]);
			}elseif( isset($request_params['filter']) )
			{	

				$patient_records = $this->model->getAdvance($request_params);
			} 
			else
			{
				$patient_records = $this->model->getAll([
					'where' => [
						'report_status' => [
							'condition' => 'in',
							'value'  => ['pending' , 'on-going']
						]
					]
				]);
			}

			$this->data['patient_records'] = $patient_records;
			
			return $this->view('patient_record/index' , $this->data);
		}

		/*
		*health-declaration
		*/
		public function create()
		{	

			if( isSubmitted() )
			{
				$post = request()->posts();

				$patient_record_id = $this->model->create($post);

				if($patient_record_id) {

					return redirect( _route('patient-record:phyical-examination' , $patient_record_id) );
				}
			}

			$user_id = request()->input('user_id');

			$this->data['page_title'] = 'Create Patient Record';

			$this->data['user'] = $this->user_model->get($user_id);

			$this->data['patient_record_form']->addUser($user_id);

			if( !empty(request()->input('pe_id')) )
			{
				$patient_record_id = request()->input('pe_id');
				$patient_record = $this->model->get($patient_record_id);

				$this->data['patient_record_form']->init([
					'url' => _route('patient-record:update')
				]);

				$this->data['patient_record_form']->addId($patient_record_id);
				$this->data['patient_record_form']->setValueObject( $patient_record );
			}

			return $this->view('patient_record/create' , $this->data);
		}


		public function createClassification($patient_record_id)
		{
			// $classification 

		}

		/*
		*physical-examination
		*create physical_examiation_details
		*patient_record_id is comming from patient-create after creation pass the id here.
		*phyiscal examination will always use update table
		*/
		public function phyicalExamination($patient_record_id)
		{	
			$patient_record = $this->model->get($patient_record_id);

			/*
			*change form to update
			*/
			$this->data['patient_record_form']->init(['url' => _route('patient-record:update' , $patient_record_id) ]);
			$this->data['patient_record_form']->addId($patient_record_id);

			$this->data['patient_record'] = $patient_record;

			$this->data['user'] = $this->user_model->get($patient_record->user_id);

			$this->data['patient_record_form']->addUser($patient_record->user_id);
			$this->data['content_title'] = 'Patient Record';

			if( !empty( request()->input('pe_id') ) )
			{
				$this->data['content_title'] = 'Patient Record Edit';
				$this->data['patient_record_form']->setValueObject( $patient_record );
			}

			return $this->view('patient_record/physical_examination' , $this->data);
		}


		public function show( $id )
		{
			$record = $this->model->getComplete($id);

			$this->data['record'] = $record;			
			return $this->view('patient_record/show' , $this->data);
		}

		/*
		*all update entry
		*/
		public function update()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$is_updated = $this->model->update($post , $post['id']);

				Flash::set('Record Updated!');

				return redirect( _route('patient-record:show' , $post['id']));
			}
		}

		public function complete($id)
		{
			$res = $this->model->complete($id);

			if($res) {
				Flash::set( $this->model->getMessageString());
				return redirect(_route('patient-record:index'));
			}else{
				Flash::set( $this->model->getErrorString() , 'danger');
			}

			return request()->return();
		}
	}