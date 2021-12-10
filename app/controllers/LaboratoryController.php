<?php 
	
	load(['LaboratoryForm'] , APPROOT.DS.'form');

	use Form\LaboratoryForm;

	class LaboratoryController extends Controller
	{

		public function __construct()
		{
			parent::__construct();


			$this->data['page_title'] = ' Laboratory Result Page';
			$this->data['lab_form'] = new LaboratoryForm();

			$this->model = model('LaboratoryModel');
			$this->patient_record = model('PatientRecordModel');
			$this->user = model('UserModel');
		}

		public function index()
		{
			$this->data['laboratory_results'] = $this->model->getAll(['order' => 'lab.id desc']);

			return $this->view('laboratory/index' , $this->data);
		}

		public function create()
		{
			$record_id = request()->input('record_id');
			
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post);

				if($res){
					Flash::set("Laboratory Result Created");
				}else{
					Flash::set("Unable to create laboratory record");
					return request()->return();
				}

				if( isset($post['request_id']) )
				{
					$this->lab_request_model = model('LaboratoryRequestModel');

					$this->lab_request_model->update([
						'result_id' => $res,
						'status'    => 'completed'
					] , $post['request_id']);

					return redirect(_route('lab-request:show' , $post['request_id']));
				}
					

				return redirect(_route('lab:show' , $res));
			}


			$this->data['record'] = $this->patient_record->getComplete($record_id);

			$lab_form = $this->data['lab_form'];

			$lab_form->addPatientId($this->data['record']->user_id);
			$lab_form->addRecordId($this->data['record']->id);
			$lab_form->addDoctorId( whoIs('id') );

			$this->data['lab_form'] = $lab_form;

			return $this->view('laboratory/create' , $this->data);
		}

		public function show($id)
		{
			$input_params = request()->inputs();

			$this->data['lab_result'] = $this->model->get($id);

			$this->data['record'] = $this->patient_record->getComplete($this->data['lab_result']->record_id);
			
			$this->data['patient'] = $this->user->get($this->data['lab_result']->patient_id);

			if(isset($input_params['prepare_print']))
				return $this->view('laboratory/partial/printable' , $this->data);

			$this->data['lab_form']->setValueObject( $this->data['lab_result'] );


			$this->data['public_link'] = $this->model->publicLink( $id );
			
			return $this->view('laboratory/show' , $this->data);
		}

		public function viewPublic()
		{
			$params = request()->inputs();

			if( isset($params['token'] , $params['id']) )
			{
				if( unseal($params['token']) == APP_KEY )
					return $this->show( unseal($params['id']) );
			}

			echo die('Invalid Access!');
		}


		public function sendToMail()
		{
			if( isSubmitted() )
			{
				$this->model->sendToMail(request()->posts());

				Flash::set('Email sent');
				return request()->return();
			}
		}

		public function edit($id)
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->save($post , $post['id']);

				if($res) {
					Flash::set("Laboratory Result Record Updated");
					return redirect( _route('lab:show' , $post['id']) );
				}else
				{
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}
			}

			$lab_result = $this->model->get($id);
			$this->data['record'] = $this->patient_record->getComplete($lab_result->record_id);


			$lab_form = $this->data['lab_form'];
			$lab_form->setValueObject($lab_result);
			$lab_form->setValue('submit' , 'Save Changes');
			$lab_form->addId( $lab_result->id );
			$lab_form->init([
				'url' => _route('lab:edit' , $id)
			]);

			$this->data['lab_form'] = $lab_form;

			return $this->view('laboratory/edit' , $this->data);
		}
	}