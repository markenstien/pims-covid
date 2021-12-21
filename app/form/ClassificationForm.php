<?php 

	namespace Form;

	use Core\Form;
	load(['Form'] , CORE);

	class ClassificationForm extends Form
	{

		public function __construct()
		{
			parent::__construct();

			$this->name = 'classification_form';

			$this->init([
				'url' => _route('classification:create')
			]);

			$this->addName();
			$this->addDescription();
			$this->addRemarks();

			$this->customSubmit('Create Classification');
		}


		public function addName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'name',
				'required' => true,
				'class' => 'form-control',
				'options' => [
					'label' => 'Classification Name'
				]
			]);
		}

		public function addDescription()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'description',
				'required' => true,
				'class' => 'form-control',
				'options' => [
					'label' => 'Description'
				]
			]);
		}

		public function addRemarks()
		{
			$this->add([
				'type' => 'text',
				'name' => 'severity_name',
				'required' => true,
				'class' => 'form-control',
				'options' => [
					'label' => 'Remarks'
				]
			]);
		}
	}