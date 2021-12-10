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

			'allergies',
			'meds',
			'remarks',
			'severerity',
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



		public function save($laboratory_data , $id = null)
		{
			$_fillables = $this->getFillablesOnly($laboratory_data);

			
			$this->patient_record = model('PatientRecordModel');
			
			$patient_record = $this->patient_record->get($_fillables['record_id']);

			$severity = $this->labResultGetRemarks(...[
				$patient_record->respirator_rate_num,
				$_fillables['pneumonia'],
				$patient_record->oxygen_level_num,
				$patient_record->is_fever
			]);

			$_fillables['severity'] = $severity;


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

			$recipients = explode(',' , $recipients);


			_mail($recipients , $subject , $body);

			return true;
		}
	}