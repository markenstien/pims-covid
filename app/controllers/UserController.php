<?php 
	load(['UserForm' , 'AddressForm'] , APPROOT.DS.'form');
	use Form\UserForm;
	use Form\AddressForm;

	class UserController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->model = model('UserModel');
			$this->address_form = new AddressForm();

			$this->lab_model = model('LaboratoryModel');
			$this->deployment = model('DeployModel');


			$this->data['page_title'] = ' Users ';

			$this->data['user_form'] = new UserForm();

			$this->data['whoIs'] = whoIs();
		}

		public function index()
		{
			$params = request()->inputs();

			if( !empty($params) )
			{
				$this->data['users'] = $this->model->getAll([
					'where' => $params
				]);
			}else{
				$this->data['users'] = $this->model->getAll( );
			}
			

			return $this->view('user/index' , $this->data);
		}

		public function edit($id)
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$post['profile'] = 'profile';
				$res = $this->model->update($post , $post['id']);

				if($res) {
					Flash::set( $this->model->getMessageString());
					return redirect( _route('user:show' , $id) );
				}else
				{
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}
			}

			$user = $this->model->get($id);

			$this->data['id'] = $id;
			$this->data['user_form']->init([
				'url' => _route('user:edit',$id)
			]);

			$this->data['user_form']->setValueObject($user);
			$this->data['user_form']->addId($id);

			$this->data['user_form']->remove('submit');
			$this->data['user_form']->remove('address');
			$this->data['user_form']->remove('password');

			$this->data['user_form']->remove('user_type');

			$this->data['user_form']->add([
				'name' => 'password',
				'type' => 'password',
				'class' => 'form-control',
				'options' => [
					'label' => 'Password'
				]
			]);

			if( !isEqual($user->user_type , ['doctor' , 'medical personel']) )
				$this->data['user_form']->remove('license_number');


			$this->address_form->remove('submit');

			if( $user->address_object )
			{
				$this->address_form->setValueObject($user->address_object);
				$this->address_form->add([
					'name' => 'address_id',
					'value' => $user->address_object->id,
					'type' => 'hidden'
				]);
			}
			
			$this->data['address_form'] = $this->address_form;

			if( !isEqual(whoIs('user_type') , 'admin') )
				$this->data['user_form']->remove('user_type');

			return $this->view('user/edit' , $this->data);
		}

		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();
				$user_id = $this->model->create($post , 'profile');
				if(!$user_id){
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set('User Record Created');
				if( isEqual($post['user_type'] , 'patient') )
				{
					Flash::set('Patient Record Created');
					return redirect(_route('patient-record:create' , null , ['user_id' => $user_id]));
				}

				return redirect( _route('user:show' , $user_id , ['user_id' => $user_id]) );
			}

			$this->data['user_form']->remove('address');
			$this->data['user_form']->remove('submit');
			$this->data['user_form']->remove('password');

			if(! isEqual(whoIs('user_type'), 'admin') ){
				$this->data['user_form']->remove('user_type');
				$this->data['user_form']->add(['name' => 'user_type' , 'type' => 'hidden' , 'value' => 'patient']);
			}
			$this->address_form->remove('submit');

			$this->data['address_form'] = $this->address_form;

			return $this->view('user/create' , $this->data);
		}

		public function show($id)
		{
			$user = $this->model->get($id);

			if(!$user) {
				Flash::set(" This user no longer exists " , 'warning');
				return request()->return();
			}

			$this->data['user'] = $user;

			$this->data['laboratory_results'] = $this->lab_model->getByPatient($id);

			$this->data['is_admin'] = $this->is_admin;

			//recent
			$deployment = $this->deployment->getRecent($id);

			$number_of_days_after_deployment = null;
			$number_of_days_remaining = null;
			
			if($deployment)
			{
				$number_of_days_after_deployment = date_difference( $deployment->deployment_date, date('Y-m-d'));
				$number_of_days_remaining = abs(( abs($number_of_days_after_deployment) - 14));
			}
			
			$this->data['number_of_days_remaining'] = $number_of_days_remaining;
			$this->data['number_of_days_after_deployment'] = $number_of_days_after_deployment;

			return $this->view('user/show' , $this->data);
		}

		public function sendCredential($id)
		{
			$user = $this->model->get($id);

			$company_name = COMPANY_NAME;

			$login_href = URL.DS._route('auth:login');

			$link = "<a href='{$login_href}'> Click here to login </a>";

			$message = <<<EOF
				Hi , {$user->first_name} This is your credential for {$company_name}
				<ul>
					<li> Email : {$user->email} </li>
					<li> Password : {$user->password} </li>
				</ul>
				{$link}
			EOF;

			_mail($user->email, 'User Credential' , $message);

			Flash::set("Credentials has been set to the user : {$user->email}");
			return request()->return();
		}
	}