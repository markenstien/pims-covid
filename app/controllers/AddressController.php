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

		public function edit( $id )
		{
			if(isSubmitted())
			{
				$post = request()->posts();
				
				$res = $this->model->update($post , $id);

				Flash::set("Adddress Update");

				return redirect( unseal($post['redirectTo']) );

			}


			$address = $this->model->get($id);

			$params = request()->inputs();

			$this->data['page_title'] = 'Create Address';
			$this->data['params'] = $params;

			$this->_addressForm->setValueObject( $address );
			$this->_addressForm->setValue('submit' , 'Save Address');
			$this->_addressForm->add([
				'name' => 'redirectTo',
				'value' => $params['route'],
				'type' => 'hidden'
			]);

			$this->_addressForm->init([
				'url' => _route('address:edit' , $id)
			]);

			$this->data['address_form'] = $this->_addressForm;

			return $this->view('address/edit' , $this->data);
		}
	}