<?php 

	class DeployModel extends Model
	{
		public $table = 'deployments';

		public $_fillables = [
			'id',
			'reference',
			'type',
			'deployment_date',
			'hospital_id',
			'attending_medical_personel_id',
			'is_released',
			'release_remarks',
			'record_id',
			'created_by',
			'notes',
			'record_status'
		];

		public function create($deployment_data)
		{
			$record_model = model('PatientRecordModel');

			$_fillables = $this->getFillablesOnly($deployment_data);
			$_fillables['reference'] = $this->getReference();
			$_fillables['created_by'] = whoIs('id');

			$record = $record_model->get($_fillables['record_id']);

			$_fillables['patient_id'] = $record->user_id;

			$deploy_id = parent::store($_fillables);

			if( !$deploy_id ){
				$this->addError("Create Deployment failed!");
				return false;
			}

			//if deployed
			$patient_record = model('PatientRecordModel');

			$patient_record->update([
				'is_deployed' => true
			] , $_fillables['record_id']);

			if(!$deploy_id) {
				$this->addError("Deploy Record Failed");
				return false;
			}

			$this->addMessage("Patient Deployed #{$_fillables['reference']}");

			return $deploy_id;
		}

		public function getReference( $hospital_id = null )
		{
			$prefix = 'HOME-';

			if( !is_null($hospital_id) )
				$prefix = 'HOSP-';

			return strtoupper($prefix.random_number(8));
		}

		public function getComplete( $id )
		{
			$deployment = parent::get($id);

			$patient_record = model('PatientRecordModel');
			$hospital = model('HospitalModel');
			$user = model('UserModel');

			$record = $patient_record->getComplete($deployment->record_id);

			$deployment->record = $record;
			$deployment->hospital = $hospital->get($deployment->hospital_id);
			$deployment->deployed_by_user = $user->get($deployment->created_by);

			return $deployment;
		}

		public function getAll( $params = [] )
		{	
			$where = null;
			$order = null;

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert($params['where']);


			$this->db->query(
				"SELECT DISTINCT * , deploy.id as id  
					FROM {$this->table} as deploy
					LEFT JOIN hospitals as hosp
					ON hosp.id = deploy.hospital_id
					LEFT JOIN users as user 
					ON user.id = deploy.patient_id
					{$where} GROUP BY deploy.id {$order}"
			);

			return $this->db->resultSet();
		}

		public function getByHospital()
		{

		}
	}