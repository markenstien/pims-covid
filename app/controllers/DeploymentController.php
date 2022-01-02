<?php 
	use Form\DeployForm;
	use Form\PatientForm;
	
	load(['DeployForm' , 'PatientForm'] , APPROOT.DS.'form');

	class DeploymentController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['form'] = new DeployForm();
			$this->model = model('DeployModel');
			$this->form_patient_respondent_model = model('RecordFormRespondentsModel');
			$this->hospital_model = model('HospitalModel');
		}

		public function index()
		{
			if( isset($_GET['filter']) )
			{
				$request = request()->inputs();

				$where = null;

				$is_hospital = isEqual($request['quarantine_type'] , 'Hospital');

				if( $is_hospital )
				{
					$where['hospital_id'] = [
						'condition' => 'not equal',
						'value' => null
					];
				}

				if( $is_hospital && !empty($request['hospital']))
				{
					$where['hospital_id'] = [
						'condition' => 'equal',
						'value' => $request['hospital']
					];
				}

				//filter by home quarantinme
				if( !$is_hospital )
				{	
					$where['deploy.type'] = [
						'condition' => 'equal',
						'value' => 'home-qurantine'
					];
				}

				$this->data['results'] = $this->model->getAll([
					'order' => 'deploy.id desc',
					'where' => $where
				]);

			}else
			{
				$this->data['results'] = $this->model->getAll([
					'order' => 'deploy.id desc'
				]);
			}
			
			$this->data['page_title'] = ' Deployed Patients ';

			$hospitals = $this->hospital_model->getAll([
				'order' => 'name asc'
			]);

			$this->data['hospitals'] = arr_layout_keypair($hospitals , ['id' , 'name']);

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

			$this->data['form']->setValue('submit' , 'Update Deployment');

			$this->data['form_patient_respondents'] = $this->form_patient_respondent_model->getByRecord( $deployment->record->id ); 

			$this->data['is_admin'] = $this->is_admin;

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

		public function destroy($id)
		{
			$deployment = $this->model->get($id);

			$patient_record_model = model('PatientRecordModel');

			$patient_record_model->update([
				'is_deployed' => false
			] , $deployment->record_id);

			parent::destroy($id);
		}
	}