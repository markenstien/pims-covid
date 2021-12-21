<?php 

	load(['Form'] , CORE);
	load(['ClassificationItemForm'] , APPROOT.DS.'form');

	use Form\ClassificationItemForm;
	use Core\Form;

	class ClassificationModel extends Model
	{

		public $table = 'classifications';

		public $_fillables = [
			'name' , 'severity_name',
			'description'
		];


		public function duplicate($id)
		{
			$classification = parent::get($id);

			if( $classification )
			{
				$classification_id = parent::store([
					'reference'     => $this->reference(),
					'severity_name' => $classification->severity_name,
					'name' => $classification->name,
					'description' => $classification->description
				]);

				$this->db->query(
					" INSERT INTO 
					classification_items(
						classification_id , 
						label,
						compare_to , 
						comparison , 
						start_number , 
						end_number,
						description,
						order_num)(
						SELECT 
						'{$classification_id}' , 
						label,
						compare_to, 
						comparison, 
						start_number, 
						end_number,
						description,
						order_num
						FROM classification_items
						WHERE classification_id = '{$id}' ) "
				);

				$res = $this->db->execute();

				return $classification_id;
			}
		}

		public function create($classification_data)
		{
			//validate
			$is_ok = $this->validate($classification_data);
			if(!$is_ok)
				return false;

			$_fillables = $this->getFillablesOnly($classification_data);

			$_fillables['reference'] = $this->reference();

			return parent::store($_fillables);
		}

		public function getComplete( $id )
		{
			$classification = parent::get($id);

			if(!$classification)
			{
				$this->addError("Classification does not exists");
				return false;
			}


			$classification_item_model = model('ClassificationItemModel');

			$items = $classification_item_model->getByClassification($id);

			$classification->items = $items;

			return $classification;
		}


		public function validate($classification_data)
		{
			extract($classification_data);

			if( isset($name) )
			{
				$res = parent::single([
					'name' => $name
				]);

				if($res) {
					$this->addError("Classificator Name {$name} already exists");
				}
			}

			if( isset($severity_name) )
			{
				$res = parent::single([
					'severity_name' => $severity_name
				]);

				if($res) {
					$this->addError("Classificator Severity Name {$severity_name} already defined");
				}
			}

			if( ! empty($this->getErrors() ) )
				return false;

			return true;
		}

		public function reference()
		{
			return strtoupper('CLS-'.random_number(8));
		}

		public function buildForm( $classification_items = [] )
		{
			$form = new Form();
			$classification_item_form = new ClassificationItemForm();
			$classification_item_model = model('ClassificationItemModel');


			$classification_items = [];


			$classification_items = $classification_item_model->getByClassification(1);

			foreach($classification_items as $key => $item) 
			{
				$item_id = $item->id;

				$hidden_input = [
					'name'  => "item[{$item_id}][id]",
					'value' => $item->id,
					'type' => 'hidden'
				];

				$form->add( $hidden_input );

				$form->add([
					'name' => 'comparison', 
					'type' => 'select',
					'options' => [
						'label' => 'Comparison',
						'option_values' => $item->comparison
					],
					'value' => $item->comparison
				]);

				if( isEqual($item->comparison , 'between') )
				{
					$form->add([
						'name' => "item[{$item_id}][start_number]",
						'type' => 'text',
						'value' => $item->start_number,
						'class' => 'form-control',
						'required' => true,
						'options' => [
							'label' => 'From Number'
						]
					]);

					$form->add([
						'name' => "item[{$item_id}][end_number]",
						'type' => 'text',
						'value' => $item->end_number,
						'class' => 'form-control',
						'required' => true,
						'options' => [
							'label' => 'From Number'
						]
					]);
				}else{
					$form->add([
						'name' => "item[{$item_id}][compare_to]",
						'type' => 'text',
						'value' => $item->compare_to,
						'class' => 'form-control',
						'required' => true,
						'options' => [
							'label' => 'Compare To'
						]
					]);
				}
			}

			return $form;
		}

	}