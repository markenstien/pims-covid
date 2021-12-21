<?php 	

	namespace Form;

	use Core\Form;
	load(['Form'] , CORE);

	class ClassificationRemarkForm extends Form
	{

		public function __construct()
		{
			parent::__construct();
			$this->name = 'classification_remark_form';

			$this->init([
				'url' => _route('remarks:create')
			]);
			$this->addPoints();
			$this->addRemarks();
			$this->addDescription();
			$this->addColor();

			$this->customSubmit('Add Remarks');
		}

		public function addPoints()
		{
			$this->add([
				'type' => 'number',
				'name' => 'points',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Points'
				]
			]);
		}

		public function addRemarks()
		{
			$this->add([
				'type' => 'text',
				'name' => 'remarks',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Remarks'
				],
				'attributes' => [
					'rows' => 4
				]
			]);
		}

		public function addColor()
		{
			$this->add([
				'type' => 'select',
				'name' => 'color',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Color',
					'option_values' => [
						'danger' => 'Red',
						'info'   => 'Blue',
						'warning' => 'Orange'
					]
				]
			]);
		}

		public function addDescription()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'description',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Description'
				],
				'attributes' => [
					'rows' => 4
				]
			]);
		}
	}