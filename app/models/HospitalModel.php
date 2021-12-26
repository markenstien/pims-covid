<?php 

	class HospitalModel extends Model
	{
		public $table = 'hospitals';

		public $_fillables = [
			'name',
			'tel',
			'phone',
			'contact_name',
			'address',
			'created_at',
			'updated_at',
			'website'
		];


		public function __construct()
		{
			parent::__construct();

			$this->address = model('AddressModel');
		}
		public function create($hospital_data)
		{
			$_fillables = $this->getFillablesOnly($hospital_data);
			return parent::store($_fillables);
		}

		public function get($id)
		{
			return $this->getAll([
				'where' => [
					'id' => $id
				]
			])[0] ?? false;
		}

		public function getAll($params = [])
		{
			$where = null;
			$order = null;

			if( isset($params['where']) )
				$where = " WHERE ".$this->conditionConvert($params['where']);
			if( isset($params['order']) )
				$order = " ORDER BY {$params['order']} ";

			$this->db->query(
				"SELECT * FROM {$this->table}
					{$where} {$order}"
			);

			$hospitals = $this->db->resultSet();

			foreach($hospitals as $hospital) 
			{
				$hospital->address = $this->address->getByModuleAndId('HOSPITAL' , $hospital->id)[0] ?? false;
			}

			return $hospitals;
		}

		public function getSummary()
		{

			$this->db->query(
				"SELECT * FROM {$this->table} as tbl
					LEFT JOIN hospitals as hp 
					ON tbl.hospital_id = hp.id"
			);

			$results = $this->db->resultSet();

			dd($results);

			$summary = [];

			foreach($results as $key => $row){

				if( !isset($summary[$row->hospital_id]) )
					$summary[$row->hospital_id] = 0;


			}
		}
	}