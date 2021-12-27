<?php 

	class UserModel extends Model
	{
		public $table = 'users';

		protected $_fillables = [
			'id',
			'user_code' ,
			'first_name',
			'middle_name',
			'last_name',
			'birthdate',
			'gender',
			'address',
			'phone_number',
			'email',
			'username',
			'password',
			'created_at',
			'created_by',
			'user_type',
			'profile',
			'updated_at'
		];


		public function get($id)
		{
			$user = parent::get($id);
			if(!$user)
				return false;

			$this->address = model('AddressModel');

			$user_address = $this->address->getByModuleAndId('USER' , $user->id)[0] ?? false;

			$user->address_object = $user_address;

			return $user;
		}

		public function save($user_data , $id = null)
		{
			$user_id = $id;

			$fillable_datas = $this->getFillablesOnly($user_data);

			$validated = $this->validate($fillable_datas , $id );

			//include age
			if( isset($fillable_datas['birthdate']) )
				$fillable_datas['age'] = $this->computeAge($fillable_datas['birthdate']);

			if(!$validated) return false;
				

			if( !is_null($id) )
			{
				//change password also
				if( empty($fillable_datas['password']) )
					unset($fillable_datas['password']);

				$res = parent::update($fillable_datas , $id);

				if( isset($user_data['profile']) ){
					$this->uploadProfile('profile' , $id);
				}

				$user_id = $id;
			}else
			{
				$fillable_datas['user_code'] = $this->generateCode($user_data['user_type']);
				$user_id = parent::store($fillable_datas);
			}
			
			return $user_id;
		}


		private function validate($user_data , $id = null)
		{
			if(isset($user_data['email']))
			{
				$is_exist = $this->getByKey('email' , $user_data['email'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Email {$user_data['email']} already used");
					return false;
				}
			}

			if(isset($user_data['username']))
			{
				$is_exist = $this->getByKey('username' , $user_data['username'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Username {$user_data['username']} already used");
					return false;
				}
			}

			if(isset($user_data['phone_number']))
			{
				$is_exist = $this->getByKey('phone_number' , $user_data['phone_number'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Phonne Number {$user_data['phone_number']} already used");
					return false;
				}
			}

			return true;
		}

		public function create($user_data , $profile = '')
		{

			$res = $this->save($user_data);

			if(!$res) {
				$this->addError("Unable to create user");
				return false;
			}

			if(!empty($profile) )
				$this->uploadProfile($profile , $res);

			$this->address = model('AddressModel');

			$user_data['module_key'] = 'USER';
			$user_data['module_id']  =  $res;
			$this->address->create($user_data);

			$this->addMessage("User {$user_data['first_name']} Created");
			return $res;
		}

		public function uploadProfile($file_name , $id)
		{
			$is_empty = upload_empty($file_name);

			if($is_empty){
				$this->addError("No file attached upload profile failed!");
				return false;
			}
			
			$upload = upload_image($file_name, PATH_UPLOAD);
			
			if( !isEqual($upload['status'] , 'success') ){
				$this->addError(implode(',' , $upload['result']['err']));
				return false;
			}

			//save to profile

			$res = parent::update([
				'profile' => GET_PATH_UPLOAD.DS.$upload['result']['name']
			] , $id);

			if($res) {
				$this->addMessage("Profile uploaded!");
				return true;
			}
			$this->addError("UPLOAD PROFILE DATABASE ERROR");
			return false;
		}

		public function update($user_data , $id)
		{
			$res = $this->save($user_data , $id);

			if(!$res) {
				$this->addError("Unable to update user");
				return false;
			}

			$this->address = model('AddressModel');
			$this->address->update($user_data , $user_data['address_id']);

			$this->addMessage("User {$user_data['first_name']} has been updated!");

			return true;
		}

		public function getByKey($column , $key , $order = null)
		{
			if( is_null($order) )
				$order = $column;

			return parent::getAssoc($column , [
				$column => "{$key}"
			]);
		}


		public function getAll( $params = [] )
		{
			$where = null;
			$order = " ORDER BY first_name asc ";

			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']}";

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert($params['where']);

			$this->db->query(
				"SELECT * FROM {$this->table}
					{$where} {$order}"
			);


			return $this->db->resultSet();

			return parent::getAssoc('first_name' , $condition);
		}

		public function generateCode($user_type)
		{
			$pfix = null;

			switch(strtolower($user_type))
			{
				case 'admin':
					$pfix = 'SUPER';
				break;

				case 'patient':
					$pfix = 'PT';
				break;

				case 'doctor':
					$pfix = 'DR';
				break;
			}

			$last_id = $this->last()->id ?? 000;

			return strtoupper($pfix.get_token_random_char(4).$last_id);
		}


		public function authenticate($email , $password)
		{
			$errors = [];

			$user = parent::single(['email' => $email]);

			if(!$user) {
				$errors[] = " Email '{$email}' does not exists in any account";
			}

			if(!isEqual($user->password ?? '' , $password)){
				$errors[] = " Incorrect Password ";
			}

			if(!empty($errors)){
				$this->addError( implode(',', $errors));
				return false;
			}

			return $this->startAuth($user->id);
		}

		/*
		*can be used to reset and start auth
		*/
		public function startAuth($id)
		{
			$user = parent::get($id);

			if(!$user){
				$this->addError("Auth cannot be started!");
				return false;
			}

			$auth = null;

			while( is_null($auth) )
			{
				Session::set('auth' , $user);
				$auth = Session::get('auth');
			}

			return $auth;
		}

		public function computeAge($birth_date)
		{
			//date in mm/dd/yyyy format; or it can be in other formats as well
			$birth_date = "12/17/1983";
			 //explode the date to get month, day and year
			$birth_date = explode("/", $birth_date);
			  //get age from date or birthdate
			$age = (date("md", date("U", mktime(0, 0, 0, $birth_date[0], $birth_date[1], $birth_date[2]))) > date("md")
			    ? ((date("Y") - $birth_date[2]) - 1)
			    : (date("Y") - $birth_date[2]));
			return $age;
		}

		public function getPatients()
		{
			
		}

		public function getSummary()
		{
			$patients = $this->getAll([
				'where' => [
					'user_type' => 'patient'
				]
			]);

			$summary = [
				'gender' => [
					'male' => 0,
					'female' => 0,
					'male_percentage' => 0,
					'female_percentage' => 0
				],

				'age_group' => [
					'20s' => '',
					'30s' => '',
					'40s' => '',
					'others' => ''
				]
			];

			foreach($patients as $key => $row) 
			{
				$age = intval($row->age);

				if( isEqual($row->gender, 'male') ){
					$summary['gender']['male']++;
				}else{
					$summary['gender']['female']++;
				}

				
				if( $age >= 40)
				{
					$summary['age_group']['40s']++;
				}else if($age >= 30){
					$summary['age_group']['30s']++;
				}else if($age >= 20)
				{
					$summary['age_group']['20s']++;
				}else{
					$summary['age_group']['others']++;
				}
			}

			//gender summary

			$gender_total = intval($summary['gender']['male']) + intval($summary['gender']['female']);

			if( $summary['gender']['male'] )
				$summary['gender']['male_percentage'] = ($summary['gender']['male'] / $gender_total) * 100;

			if( $summary['gender']['female'] )
				$summary['gender']['female_percentage'] = ($summary['gender']['female'] / $gender_total) * 100;

			return $summary;
		}
	}