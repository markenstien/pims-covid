<?php 

	namespace Form;

	use Core\Form;

	load(['Form'] , CORE);

	class ClassificationItemForm extends Form
	{

		public $comparisons = [
			'between' ,
			'in',
			'not in',
			'=','!=' , 
			'>=' , '<='
		];


		public function __construct()
		{
			parent::__construct();
			$this->name = 'classification_item_form';

			$this->init([
				'url' => _route('classification-item:create')
			]);

			$this->addLabel();
			$this->addComparison();
			$this->addCompareTo();
			$this->addStartNumber();
			$this->addEndNumber();
			$this->addDescription();
			$this->addOrder();

			$this->customSubmit('Add Item');
		}

		public function addClassificationId($classification_id)
		{
			$this->add([
				'type' => 'hidden',
				'value' => $classification_id,
				'name'  => 'classification_id'
			]);
		}

		public function addLabel()
		{
			$this->add([
				'type' => 'text',
				'name' => 'label',
				'required' => true,
				'class' => 'form-control',
				'options' => [
					'label' => 'Label Name'
				]
			]);
		}

		public function addComparison()
		{
			$this->add([
				'type' => 'select',
				'name' => 'comparison',
				'required' => true,
				'class' => 'form-control',
				'options' => [
					'label' => 'Comparison',
					'option_values' => $this->comparisons
				],
				'attributes' => [
					'id' => 'id_comparison',
					'data-target' => '#id_compare_to'
				]
			]);
		}

		

		public function addCompareTo()
		{
			$this->add([
				'type' => 'text',
				'name' => 'compare_to',
				'class' => 'form-control',
				'options' => [
					'label' => 'Compare To'
				]
			]);
		}

		public function addStartNumber()
		{
			$this->add([
				'type' => 'number',
				'name' => 'start_number',
				'class' => 'form-control',
				'options' => [
					'label' => 'From Number'
				],
				'attributes' => [
					'step' => 'any'
				]
			]);
		}

		public function addEndNumber()
		{
			$this->add([
				'type' => 'number',
				'name' => 'end_number',
				'class' => 'form-control',
				'options' => [
					'label' => 'To Number'
				],
				'attributes' => [
					'step' => 'any'
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

		public function addOrder()
		{
			$classification_item_model = model('ClassificationItemModel');


			$numbers = $classification_item_model->getNumbers();
			$order_numbers  = $numbers;

			$value = end($order_numbers);

			$this->add([
				'type' => 'select',
				'name' => 'order_num',
				'required' => true,
				'class' => 'form-control',
				'options' => [
					'label' => 'Order',
					'option_values' => $order_numbers
				],

				'value' => $value
			]);
		}
	}