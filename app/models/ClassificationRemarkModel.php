<?php 

	class ClassificationRemarkModel extends Model
	{
		public $table = 'classification_remarks';

		public $_fillables = [
			'points' , 'remarks' , 'description' , 'color'
		];


		public function __construct()
		{
			parent::__construct();

			$this->criteria_model = model('ClassificationItemModel');
		}

		public function create($classification_remark_data)
		{	
			$_fillables = $this->getFillablesOnly($classification_remark_data);

			return parent::store( $_fillables );
		}

		public function save($classification_remark_data , $id)
		{
			$_fillables = $this->getFillablesOnly($classification_remark_data);

			return parent::update( $_fillables , $id );
		}

		public function compare($points)
		{
			$this->db->query(
				"SELECT * FROM {$this->table}
					WHERE points >= '{$points}'
					ORDER BY points asc limit 1"
			);

			$remark = $this->db->single();

			if(!$remark)
				return $this->getLowest();
			return $remark;
		}

		public function getLowest()
		{
			$this->db->query(
				"SELECT * FROM {$this->table}
					ORDER BY points asc limit 1"
			);

			return $this->db->single();
		}
	}