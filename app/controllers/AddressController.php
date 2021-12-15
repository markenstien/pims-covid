<?php 

	class AddressController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->model = model('AddressModel');
		}

		public function create()
		{
			if(isSubmitted())
			{
				$post = request()->posts();

				$res = $this->model->create($post);

				Flash::set("Adddress created");

				return redirect( unseal($post['redirectTo']) );

			}
			$params = request()->inputs();

			$this->data['page_title'] = 'Create Address';
			$this->data['params'] = $params;

			

			$this->_addressForm->addModule($params['module']);
			$this->_addressForm->addModuleId($params['id']);
			$this->_addressForm->addRedirecTo($params['redirect']);

			$this->data['address_form'] = $this->_addressForm;

			return $this->view('address/create' , $this->data);
		}
	}