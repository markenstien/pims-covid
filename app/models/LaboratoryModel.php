<?php 

	class LaboratoryModel extends Model
	{	
		CONST SEVERITY = [
			'miled' => 2,
			'moderate' => 3,
			'sever'  => 4
		];


		public $table = 'laboratory_results';

		public $_fillables = [
			'reference',	
			'record_id',
			'patient_id',
			'doctor_id',

			'date_requested',
			'date_reported',
			'abnormalities',

			'densities',
			'pneumonia',

			'rbc',
			'wbc',
			'color',

			'clarity',
			'ketones',
			'ova',
			'larva',
			'adult_forms',
			'severity',
			'classify_doc_id',

			'allergies',
			'meds',
			'remarks',
			'quarantine',
			'pathologist',
			'medical_technologist',
			'notes',

			'created_at'
		];


		public function create( $laboratory_data )
		{
			return $this->save($laboratory_data);
		}



		public function classify($laboratory_data , $id = null)
		{
			$save_action = $this->save($laboratory_data , $id);

			//update patient record
			if( $save_action )
			{
				$lab_result = parent::get($id);

				//load patient record model
				$this->patient_record = model('PatientRecordModel');

				$res = $this->patient_record->update([
					'doctors_approval' => whoIs('id')
				] , $lab_result->record_id );

				$this->record_id = $lab_result->record_id;
			}

			return $save_action;
		}

		public function save($laboratory_data , $id = null)
		{
			$_fillables = $this->getFillablesOnly($laboratory_data);

			
			$this->patient_record = model('PatientRecordModel');
			
			$patient_record = $this->patient_record->get($_fillables['record_id']);

			if( !isset($_fillables['severity']) )
			{
				$severity = $this->labResultGetRemarks(...[
					$patient_record->respirator_rate_num,
					$_fillables['pneumonia'],
					$patient_record->oxygen_level_num,
					$patient_record->is_fever
				]);

				$_fillables['severity'] = $severity;
			}


			if( !is_null($id))
			{
				return parent::update($_fillables , $id);
			}else
			{
				$_fillables['reference'] = $this->createReference();
				return parent::store($_fillables);
			}
		}

		public function createReference()
		{
			return strtoupper(random_number(3).'-'.random_letter(5));
		}


		public function getByPatient($patient_id)
		{
			return $this->getAll([
				'where' => [
					'patient_id' => $patient_id
				],
				'order' => ' lab.id desc '
			]);
		}

		public function getAdvance( $params = [])
		{
			$where_parameter = $params['where'];

			$where = [];

			if(!empty($where_parameter['start_date']) && !empty($where_parameter['end_date'])) {

				$where['date_reported'] = [
					'condition' => 'between',
					'value'     => [$where_parameter['start_date'] , $where_parameter['end_date']],
					'concatinator' => 'AND'
				];
			}


			if( !empty($where_parameter['category']) )
			{
				if( isEqual($where_parameter['category'] , 'Approved'))
				{
					$where['lab.classify_doc_id'] = [
						'condition' => 'not equal',
						'value'     => '0',
						'concatinator' => 'AND'
					];
				}else
				{
					$where['lab.classify_doc_id'] = [
						'condition' => 'equal',
						'value'     => '0',
						'concatinator' => 'AND'
					];
				}
				
			}

			$_fillables = $this->getFillablesOnly($where_parameter);

			$where = array_merge($where , $_fillables);
			$where = array_filter($where);


			return $this->getAll([
				'where' => $where,
				'order' => $params['order'] ?? null
			]);
		}

		public function getAll( $params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE " .$this->conditionConvert($params['where']);

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			$this->db->query(
				"SELECT lab.* , 
					concat(patient.last_name , ',' , patient.first_name , ' ' , patient.middle_name)
					as patient_name , patient.user_code as patient_code ,

					concat('DR/DRA' , ' . ',doctor.last_name , ',' , doctor.first_name , ' ' , doctor.middle_name)
					as doctor_name , doctor.user_code as doctor_code

					FROM {$this->table} as lab
					LEFT JOIN users as doctor
					ON doctor.id = lab.doctor_id

					LEFT JOIN users as patient
					ON patient.id = lab.patient_id

					{$where} {$order} "
			);

			return $this->db->resultSet();
		}

		public function get($id)
		{
			return $this->getAll([
				'where' => [
					'lab.id' => $id
				]
			])[0] ?? false;
		}

		/*
		*10:30
		*/
		private function labResultGetRemarks($respiratory_rate , $pneumonia , $oxygen_level , $fever)
		{
			$points = 0;

			if( floatval($respiratory_rate)  > 31)
				$points++;

			if( $pneumonia )
				$points += 2;

			if( floatval($oxygen_level) < 95 )
				$points ++;

			if( $fever)
				$points ++;


			if( $points < 3)
				return 'MILD'; 

			if( $points < 4)
				return 'MODERATE';
			if( $points >= 4)
				return 'SEVERE';
		}

		public function publicLink($id)
		{
			return URL.DS._route('lab:view-public', null , [
				'token' => seal(APP_KEY),
				'id'    => seal($id)
			]);
		}


		public function sendToMail($email_data)
		{

			$lab_id = $email_data['lab_id'];
			$recipients = $email_data['recipients'];
			$subject = $email_data['subject'];
			$body = $email_data['body'];


			if(empty($recipients))
			{
				$this->addError("No recipients found!");
				return false;
			}

			$lab = $this->get($lab_id);

			$recipients = explode(',' , $recipients);


			$template = pull_view('laboratory/partial/tmp_email_result' , [
				'lab_result' => $lab,
				'public_link' => $this->publicLink($lab->id)
			]);

			if( !empty($body))
				$template .= " <div stlye='margin-top:40px'> Notes from sender : <p>{$body}</p> </div>";

			_mail($recipients , $subject , $template);

			return true;
		}
	}