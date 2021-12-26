<?php 

	class PatientRecordModel extends Model
	{	

		public $table = 'patient_records';

		protected $_fillables = [
			'reference',
			'blood_presure_num',
			'temperature_num',
			'pulse_rate_num',
			'respirator_rate_num',
			'height_num',
			'weight_num',
			'oxygen_level_num',

			'pulse_rate_remarks',
			'respirator_rate_remarks',
			'oxygen_level_remarks',
			'is_fever',
			'is_headache',
			'is_body_pains',
			'is_sore_throat',
			'is_diarrhea',
			'is_lost_of_taste_smell',
			'is_dificulty_breathing',
			'completion_status',

			'date',
			'time',
			'user_id',
			'created_by',
			'updated_by',
			'created_at',
			'updated_ons',
			'doctors_approval',
			'is_deployed',
			'report_status'
		];


		public function create($record_data)
		{
			$record_data['reference'] = $this->createRefence();
			$record_data['created_by'] = whoIs('id');
			$_fillables = $this->getFillablesOnly($record_data);
			

			$user_id = $_fillables['user_id'];

			$record_id = parent::store($_fillables);

			$attr = [
				'href' => _route('patient-record:show' , $record_id),
				'heading' => 'Patient Record'
			];

			_notify("a medical record has been created for you." , [$user_id] , $attr);
			_notify_operations("staff ".whoIs('first_name')." created record for " ._user($user_id)->first_name , $attr);

			return $record_id;
		}

		public function update($record_data , $id)
		{
			$_fillables = $this->getFillablesOnly($record_data);
			return parent::update($_fillables , $id);
		}

		public function getAdvance($where_parameter)
		{
			$where = [];

			if( !empty($where_parameter['start_date']) && !empty($where_parameter['end_date']) )
			{
				$where['date'] = [
					'condition' => 'between',
					'value' => [$where_parameter['start_date'] , $where_parameter['end_date']],
					'concatinator' => 'AND'
				];
			}

			$fillable_datas = $this->getFillablesOnly($where_parameter);

			$where = array_merge($where , $fillable_datas);
			$where = array_filter($where);
			
			return $this->getAll([
				'where' => $where
			]);

		}


		public function getAll($params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert($params['where']);

			$this->db->query(
				"SELECT record.* , user.*, record.id as id 
					FROM {$this->table} as record
					LEFT JOIN users as user 
					ON user.id = record.user_id
					{$where} {$order} "
			);

			return $this->db->resultSet();
		}

		public function createRefence()
		{
			return strtoupper( random_number(3).'-'.random_letter(5) );
		}

		public function complete($id)
		{
			$res = parent::update([
				'report_status' => 'completed'
			] , $id );

			$patient_record = parent::get($id);

			if($res) {
				$this->addMessage("Patient Record #{$patient_record->reference}");
				return $res;
			}else{
				$this->addError("Patient Record Update failed");
			}
			return true;
		}

		public function getComplete($id)
		{
			$record = $this->getAll([
				'where' => [
					'record.id' => $id
				]
			])[0] ?? false;

			if(!$record) 
				return $record;

			$lab_request_model = model('LaboratoryRequestModel');
			$lab_model = model('LaboratoryModel');
			$deploy_model = model('DeployModel');


			$lab_requests = $lab_request_model->getAll([
				'where' => [
					'record_id' => $id,
				],
				'order' => 'lab_req.id desc'
			]);

			$lab_results = $lab_model->getAll([
				'where' => [
					'record_id' => $id,
				],
				'order' => 'lab.id desc'
			]);

			$record->lab_results = $lab_results;
			$record->lab_requests = $lab_requests;
			$deployed = $deploy_model->getAll([
				'where' => [
					'record_id' => $record->id
				]
			])[0] ?? false;

			$record->deployment = $deployed;

			$record->forms = $this->getForm($record->id);
			$record->classification = $this->getClassification($record->id);

			return $record;
		}

		public function killFormResponding()
		{
			Session::remove('patient_record_forms');
		}

		public function startFormResponding()
		{
			$session_data = $this->getFormResponding();

			if( $session_data )
				return $session_data;

			$form_model = model('FormBuilderModel');
			$forms = $form_model->getAssoc('order_num');

			$session_data = [];

			if(!$forms) 
				return false;

			foreach($forms as $key => $row) 
			{
				array_push($session_data , [
					'form_id' => $row->id,
					'status'  => 'pending'
				]);
			}

			Session::set('patient_record_forms' , $session_data);
			
			return $this->getFormResponding();
		}

		public function getFormResponding()
		{
			return Session::get('patient_record_forms') ?? false;
		}

		public function skipFormResponding($id)
		{
			$form_responding = $this->getFormResponding();

			foreach($form_responding as $key => $res) 
			{
				if( isEqual($res['form_id'] , $id) )
					$form_responding[$key]['status'] = 'completed';
			}

			Session::set('patient_record_forms' , $form_responding);
		}

		public function getForm($record_id)
		{
			$this->record_form_respondent_model = model('RecordFormRespondentsModel');

			return $this->record_form_respondent_model->getByRecord( $record_id );
		}

		public function getClassification($record_id)
		{
			$this->classification_respondent_model = model('ClassificationRespondModel');

			return $this->classification_respondent_model->getByRecord( $record_id );
		}

		/*
		*items and form
		*/
		public function processFormRespond($respond_data , $record_id)
		{
			/*
			*load form respond model
			*/
			$form_respondent_model = model('FormRespondentModel');

			$record_form_respondent = model('RecordFormRespondentsModel');



			$form_respondent_id = $form_respondent_model->create($respond_data);

			$record_form_respondent_id = $record_form_respondent->create([
				'record_id' => $record_id,
				'user_id'   => $respond_data['user_id'],
				'form_respondent_id' => $form_respondent_id
			]);

			$this->skipFormResponding($respond_data['form_id']);

			return $record_form_respondent_id;
		}
	}