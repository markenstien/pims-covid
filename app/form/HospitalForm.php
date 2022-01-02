<?php 
	namespace Form;

	use Core\Form;
	load(['Form'] , CORE);

	class HospitalForm extends Form 
	{

		public function __construct()
		{
			parent::__construct();
			$this->name = 'hospital_form';

			$this->init([
				'url' => _route('hospital:create')
			]);
			$this->addName();
			$this->addPhone();
			$this->addEmail();
			$this->addCapacity();
			$this->addWebsite();

			$this->customSubmit('Create Hospital');
		}

		public function addName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'name',
				'required' => true,
				'options' => [
					'label' => 'Hospital Name'
				],
				'class' => 'form-control'
			]);
		}

		public function addPhone()
		{
			$this->add([
				'type' => 'text',
				'name' => 'phone',
				'required' => true,
				'options' => [
					'label' => 'Hospital Tel/Phone Number'
				],
				'class' => 'form-control'
			]);
		}

		public function addEmail()
		{
			$this->add([
				'type' => 'text',
				'name' => 'email',
				'required' => true,
				'options' => [
					'label' => 'Email'
				],
				'class' => 'form-control'
			]);
		}

		public function addWebsite()
		{
			$this->add([
				'type' => 'text',
				'name' => 'website',
				'required' => true,
				'options' => [
					'label' => 'Website'
				],
				'class' => 'form-control'
			]);
		}

		public function addCapacity()
		{
			$this->add([
				'type' => 'text',
				'name' => 'capacity',
				'required' => true,
				'options' => [
					'label' => 'Capacity'
				],
				'class' => 'form-control'
			]);
		}

		public function addAddress()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'address',
				'required' => true,
				'options' => [
					'label' => 'Hospital Address'
				],
				'class' => 'form-control'
			]);
		}
	}