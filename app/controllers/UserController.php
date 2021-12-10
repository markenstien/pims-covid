<?php 
	load(['UserForm'] , APPROOT.DS.'form');
	use Form\UserForm;

	class UserController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->model = model('UserModel');
			$this->lab_model = model('LaboratoryModel');

			$this->data['page_title'] = ' Users ';

			$this->data['user_form'] = new UserForm();

			$this->data['whoIs'] = whoIs();
		}

		public function index()
		{
			$params = request()->inputs();

			if( !empty($params) )
			{
				$this->data['users'] = $this->model->getAll( $params );
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
			$this->data['user_form']->remove('password');

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

				Flash::set('User Record Created');

				if(!$user_id){
					Flash::set( $this->model->getErrorString() , 'danger');
				}
				if( isEqual($post['user_type'] , 'patient') )
				{
					Flash::set('Patient Record Created');
					return redirect(_route('patient-record:create' , null , ['user_id' => $user_id]));
				}

				return redirect( _route('user:show' , $user_id) );
			}

			if(! isEqual(whoIs('user_type'), 'admin') ){
				$this->data['user_form']->remove('user_type');
				$this->data['user_form']->add(['name' => 'user_type' , 'type' => 'hidden' , 'value' => 'patient']);
			}

			return $this->view('user/create' , $this->data);
		}

		public function show($id)
		{
			$user = $this->model->get($id);

			$this->data['user'] = $user;

			$this->data['laboratory_results'] = $this->lab_model->getByPatient($id);

			return $this->view('user/show' , $this->data);
		}
	}