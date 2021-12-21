<?php 

	class ClassificationRemarkModel extends Model
	{
		public $table = 'classification_remarks';

		public $_fillables = [
			'points' , 'remarks' , 'description' , 'color'
		];

		public function create($classification_remark_data)
		{	
			$_fillables = $this->getFillablesOnly($classification_remark_data);

			return parent::store( $_fillables );
		}
	}