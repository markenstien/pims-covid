<?php 

	class Hospital extends Controller
	{

		public function __construct()
		{
			$this->hospital = model('HospitalModel');
		}

		public function get()
		{
			$hospital_id = request()->input('hospital_id');

			$hospital = $this->hospital->get($hospital_id);

			ee([
				'hospital_id' => $hospital_id,
				'hospital' => $hospital
			]);
		}
	}