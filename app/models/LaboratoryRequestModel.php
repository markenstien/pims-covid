<?php 

	class LaboratoryRequestModel extends Model
	{

		public $table = 'laboratory_requests';

		public $_fillables = [
			'record_id' , 'patient_id',
			'date_requested' , 'status',
			'notes' , 'created_by',
			'created_at' , 'updated_by'
		];



		public function create($laboratory_request_data)
		{
			$_fillables = $this->getFillablesOnly($laboratory_request_data);
			$_fillables['reference'] = $this->token->createMix('LABRQ-');


			$lab_req_id = parent::store($_fillables);

			$attr = [
				'href' => _route('lab-request:show' , $lab_req_id),
				'heading' => 'Laboratory Result Request'
			];

			_notify("your lab result is on its way." , [$_fillables['patient_id']] , $attr);
			_notify_operations("staff ".whoIs('first_name')." is requesting a lab-result for patient " ._user($_fillables['patient_id'])->first_name);
			

			return $lab_req_id;
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
				"SELECT lab_req.* , 
					concat(patient.last_name , ',' , patient.first_name , ' ' , patient.middle_name)
					as patient_name ,patient.user_code as patient_code,

					concat('DR/DRA', '.' ,doctor.last_name , ',' , doctor.first_name , ' ' , doctor.middle_name)
					as doctor_name , doctor.user_code as doctor_code

					FROM {$this->table} as lab_req
					LEFT JOIN users as doctor
					ON doctor.id = lab_req.created_by

					LEFT JOIN users as patient
					ON patient.id = lab_req.patient_id

					{$where} {$order} "
			);

			return $this->db->resultSet();
		}

		public function get($id)
		{
			return $this->getAll(['where' => ['lab_req.id' => $id] ])[0] ?? false;
		}
	}