<?php 

	class ClassificationItemModel extends Model
	{
		public $table = 'classification_items';


		public $_fillables = [
			'classification_id',
			'label',
			'points',
			'compare_to',
			'comparison',
			'start_number',
			'end_number',
			'description',
			'order_num'
		];	


		public function getByClassification($id)
		{
			return $this->getAll([
				'where' => [
					'classification_id' => $id,
				],
				
				'order' => 'order_num asc'
			]);
		}

		public function getAll($params = [] )
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert( $params['where'] );

			if( isset($params['order']))
				$order = " ORDER BY ".$params['order'];

			$this->db->query(
				"SELECT *,
					CASE 
						WHEN comparison = 'between' THEN CONCAT('Compare between' , ' ' , start_number , ' And ' , end_number)
						ELSE CONCAT('COMPARE BY' , ' \" ', comparison , ' \" VALUE :' ,compare_to )
							END AS  compare_by
						FROM {$this->table}
					{$where} {$order}"
			);



			return $this->db->resultSet();
		}

		public function save($classification_item_data , $id)
		{
			if( !$this->validate($classification_item_data) )
				return false;

			$_fillables = $this->getFillablesOnly($classification_item_data);

			$res = parent::update($_fillables , $id);

			if($res) {
				$this->addMessage("Classification Update");
				return true;
			}
			
			$this->addError("Classification failed to update");

			return false;
		}

		public function create($classification_item_data)
		{
			if( !$this->validate($classification_item_data) )
				return false;

			$_fillables = $this->getFillablesOnly($classification_item_data);

			return parent::store($_fillables);
		}

		public function validate($classification_item_data)
		{
			extract($classification_item_data);

			// if( isset($label) ){

			// 	$item = parent::single(['label' => $label]);

			// 	if( $item )
			// 	{
			// 		if( isset( $classification_item_data['id'] ) && !isEqual($classification_item_data['id'] , $item->id)   ){
			// 			$this->addError("Label {$label} already exists ");
			// 		}
			// 	}
			// }

			// if( isset($order_num) )
			// {
			// 	$item_data = [
			// 		'order_num' => $order_num
			// 	];


			// 	$item = parent::single($item_data);

			// 	if( $item )
			// 	{
			// 		if( isset( $classification_item_data['id'] ) && !isEqual($classification_item_data['id'] , $item->id)   ){
			// 			$this->addError("Order number {$order_num} already used ");
			// 		}
			// 	}
				
			// }

			// if(!empty($this->getErrors()))
			// 	return false;

			return true;
		}

		public function getNumbers()
		{
			$number = parent::last()->order_num ?? 0;

			if( !$number )
				$number = 0;


			$number += 1;


			$number_array = [];

			for($i = 1; $i <= $number ; $i++ ){
				array_push($number_array , $i);
			}

			return $number_array;
		}

		public function compare($id , $value)
		{
			$item = parent::get( $id );
			
			if(!$item)
				return false;

			$points = 0;

			switch( strtolower($item->comparison) )
			{
				case 'between':
					$value = floatval($value);

					if( $value >= $item->start_number && $value <= $item->end_number){
						$points += $item->points;
					}
				break;

				case '=':
				case 'in':
					if (isEqual( $value , $item->compare_to )){
						$points += $item->points;
					}
					break;
				case 'not in':
					if (!isEqual( $value , $item->compare_to )){
						$points += $item->points;
					}
					break;
				break;

				case '!=':
					if( $item->compare_to != $value ){
						$points += $item->points;
					}
					break;
				case '>=':
					if( $value >= $item->compare_to ){
						$points += $item->points;
					}
					break;
				case '<=':
					if( $value <=  $item->compare_to){
						$points += $item->points;
					}
				break;

				case '>':
					if( $value > $item->compare_to ){
						$points += $item->points;
					}
					break;
				case '<':
					if( $value < $item->compare_to){
						$points += $item->points;
					}
				break;
			}

			return $points;
		}
	}


