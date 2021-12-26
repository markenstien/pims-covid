<?php 

	class ClassificationRespondController extends Controller
	{

		public function __construct()
		{
			$this->model = model('ClassificationRespondModel');
			$this->classification_item_model = model('ClassificationItemModel');
		}

		public function respond()
		{
			$record_id = request()->input('record_id');

			if(!$record_id) {
				echo die("Invalid Request");
			}
			
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post);

				if($res) {
					Flash::set("Unable to save record" , 'danger');
					return request()->return();
				}
				Flash::set("Record Saved");
				return redirect( _route('patient-record:show' , $record_id) );
			}

			$request = request()->inputs();
			//record_id

			$data = [
				'title' => 'Classification',
				'classificators' => $this->classification_item_model->getAll(),
				'record_id' => $record_id
			];

			return $this->view('classification_respond/respond' , $data);
		}
	}