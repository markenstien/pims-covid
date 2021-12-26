<?php 

	class ClassificationRespondModel extends Model
	{

		public $table = 'classification_respondents';

		protected $_fillables = [
			'record_id' , 'items',
			'remarks' , 'id'
		];

		public function create( $classification_data )
		{
			$_fillables = $this->getFillablesOnly($classification_data);

			$remark = $this->computeRemarks( $_fillables['items'] );
			$_fillables['remarks'] = $remark->remarks;
			/*
			*compute remarks
			*/
			$_fillables['items'] = json_encode( $classification_data['items'] );
			$respond_id = parent::store($_fillables);
		}

		public function computeRemarks( $items )
		{
			$classification_item_model = model('ClassificationItemModel');
			$classification_remark_model = model('ClassificationRemarkModel');

			$points = 0;

			foreach($items as $item ) 
			{
				$clasificator_id = $item['id'];
				$value = trim($item['value']);

				$points += $classification_item_model->compare( $clasificator_id , $value);
			}

			return $classification_remark_model->compare($points);
		}

		public function getByRecord($record_id)
		{	

			$result = $this->single([
				'record_id' => $record_id
			] , '*' , 'id desc');

			if(!$result) return false;

			$result->items = json_decode($result->items);

			return $result;
		}

	}