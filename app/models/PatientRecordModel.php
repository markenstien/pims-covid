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
			'updated_ons'
		];

		public function create($record_data)
		{
			$record_data['reference'] = $this->createRefence();

			$_fillables = $this->getFillablesOnly($record_data);
			return parent::store($_fillables);
		}

		public function update($record_data , $id)
		{
			$_fillables = $this->getFillablesOnly($record_data);

			return parent::update($_fillables , $id);
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

			return $record;
			//load lab_requests
			//load lab_results
		}
	}