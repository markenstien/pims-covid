<?php 
	use Form\ClassificationForm;
	use Form\ClassificationItemForm;

	load(['ClassificationForm' , 'ClassificationItemForm'] , APPROOT.DS.'form');

	class ClassificationController extends Controller
	{	

		public function __construct()
		{
			$this->classification_form = new ClassificationForm();
			$this->classification_item_form = new ClassificationItemForm();

			$this->model = model('ClassificationModel');
		}	

		public function answer_public()
		{
			$item = $this->model->buildForm();

			echo $item->getForm();
		}

		public function index()
		{
			$this->data['classifications'] = $this->model->getAssoc('id');

			return $this->view('classification/index' , $this->data);
		}


		public function show($id)
		{
			$classification = $this->model->getComplete($id);

			$this->data['classification'] = $classification;
			$this->data['title'] = 'Classification';

			return $this->view('classification/show' , $this->data);
		}

		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post);

				Flash::set( " Classification Created !"); 
				
				if(!$res) {
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return(); 
				}

				return redirect( _route('classification:show' , $res) );
			}

			$this->data['title'] = 'Classification Title';
			$this->data['classification_form'] = $this->classification_form;

			return $this->view('classification/create' , $this->data);
		}

		public function edit()
		{
			
		}

		public function duplicate($id)
		{
			$res = $this->model->duplicate($id);

			if($res) {
				Flash::set($this->model->getMessageString());
				return redirect( _route('classification:show' , $res) );
			}
		}
	}