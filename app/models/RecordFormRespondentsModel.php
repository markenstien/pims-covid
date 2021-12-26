<?php
	class RecordFormRespondentsModel extends Model
	{
		public $table = 'record_form_respondents';

		public $_fillables = [
			'record_id',
			'form_respondent_id',
			'user_id',
			'created_at',
			'updated_at'
		];

		public function create( $record_data )
		{
			$_fillables = $this->getFillablesOnly( $record_data );

			return parent::store( $_fillables );
		}

		public function getByRecord( $record_id )
		{
			$this->db->query(
				"SELECT * , rfr.id 
				FROM {$this->table} as rfr
				LEFT JOIN form_respondents as fr
				ON fr.id = rfr.form_respondent_id
				WHERE record_id = '{$record_id}' "
			);

			$results = $this->db->resultSet();

			$ret_val = [];

			foreach($results as $key => $row) 
			{
				$row->form_data  = json_decode($row->form_detail);
				$row->form_items = json_decode($row->items);

				array_push($ret_val , $row);
			}

			return $ret_val;
		}
	}
?>