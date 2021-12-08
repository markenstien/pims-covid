<?php 
	load(['UserForm'] , APPROOT.DS.'form');
	use Form\UserForm;

	class UserController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->model = model('UserModel');

			$this->data['page_title'] = ' Users ';

			$this->data['user_form'] = new UserForm();
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

		public function create()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$user_id = $this->model->create($post);

				Flash::set('User Record Created');

				if(!$user_id){
					Flash::set( $this->model->getErrorString() , 'danger');
				}
				if( isEqual($post['user_type'] , 'patient') )
				{
					Flash::set('Patient Record Created');
					return redirect(_route('patient-record:create' , null , ['user_id' => $user_id]));
				}
			}

			return $this->view('user/create' , $this->data);
		}
	}