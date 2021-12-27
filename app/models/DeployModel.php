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

		public function release($release_data , $id)
		{
			$release_data = $this->getFillablesOnly($release_data);
			$release_data['is_released'] = true;
				
			$deployment = parent::get($id);

			$attr = [
				'href' => _route('deployment:show' , $id),
				'heading' => 'Hospital Deployment Released'
			];

			if( isEqual($release_data['release_remarks'] , 'recovered') )
			{

				$record_model = model('PatientRecordModel');
				$record = $record_model->get($_fillables['record_id']);

				$message_operations = "Patient "._user($record->user_id)->first_name. " recovered.";
				$message_patient = "Congratulations for your recovery";

				if( !is_null($deployment->hospital_id) ){
					$message_operations .= " Hospital Quarantine Treatment";
				}else{
					$message_operations .= " Home Quarantine Treatment";
				}

				_notify_operations($message_operations , $attr);
				_notify($message_patient,[$record->user_id] , $attr);

				$this->addMessage("Patient Deployed #{$_fillables['reference']}");
			}else
			{
				_notify_operations("its very unfortunate that one of our patient was not able to recover
						from covid" , $attr);
			}
			return parent::update( $release_data , $id);
		}

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


			if( isset($_fillables['hospital_id']) )
			{
				$hospital_model = model('HospitalModel');
				$hospital_name = $hospital_model->get($_fillables['hospital_id'])->name;
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


			$attr = [
				'href' => _route('deployment:show' , $deploy_id),
				'heading' => 'Hospital Deployment'
			];

			$message_operations = "Patient "._user($record->user_id)->first_name. " has been deployed to ";
			$message_patient = "you are being deployed to";
			if( isset($hospital_name) ){
				$message_operations .= " Hospital({$hospital_name}) , on {$_fillables['deployment_date']}";
				$message_patient .= " Hospital ({$hospital_name}) for Quarantine and medications , on {$_fillables['deployment_date']}";
			}else{
				$message_operations .= " Home Quarantine , on {$_fillables['deployment_date']}";
				$message_patient .= " Home Quarantine , on {$_fillables['deployment_date']}";
			}

			$message_operations .= " By Staff ".whoIs('first_name');

			_notify_operations($message_operations , $attr);
			_notify($message_patient,[$record->user_id] , $attr);

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
			$deployment->deployed_by_user = $user->get($deployment->attending_medical_personel_id);

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
				"SELECT DISTINCT * , deploy.id as id  ,
					hosp.name as hospital_name
					FROM {$this->table} as deploy
					LEFT JOIN hospitals as hosp
					ON hosp.id = deploy.hospital_id
					LEFT JOIN users as user 
					ON user.id = deploy.patient_id
					{$where} GROUP BY deploy.id {$order}"
			);

			return $this->db->resultSet();
		}

		public function getSummary()
		{
			$results = $this->getAll();

			$summary = [];

			$total = 0;
			foreach($results as $key => $row)
			{
				$total++;

				if( !isset( $summary[ $row->hospital_name ] ) )
					$summary[$row->hospital_name] = 0;
				$summary[$row->hospital_name]++;
			}

			$ret_val = [];

			foreach($summary as $key => $row)
			{	
				$ret_val[$key] =  round(($row / $total) * 100, 2) ;
			}

			return $ret_val;
		}

		public function getByHospital($id)
		{
			return $this->getAll([
				'where' => 'hosp.id = '.$id,
				'order' => "is_released asc"
			]);
		}

		
	}