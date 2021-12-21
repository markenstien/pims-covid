<?php 
	use Form\ClassificationCriteriaForm;

	load(['ClassificationCriteriaForm'] , APPROOT.DS.'form');

	class ClassificationCriteriaController extends Controller
	{

		public function __construct()
		{
			$this->form = new ClassificationCriteriaForm();
			$this->model = model('ClassificationItemModel');
		}

		public function index()
		{
			$this->data['criterias'] = $this->model->getAll(['order' => 'label asc']);
			$this->data['page_title'] = 'Classification Criterias';

			return $this->view('classification_criteria/index' , $this->data);
		}


		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create( $post );

				if(!$res) {
					Flash::set( "Something went wrong!" , 'danger');
					return request()->return();
				}

				Flash::set(" Criteria has been created {$post['remarks']} ");

				return redirect( _route('criteria:index') );
			}
			
			$this->data['page_title'] = 'Create Criteria';
			$this->data['form'] = $this->form;

			return $this->view('classification_criteria/create' , $this->data);
		}
		
	}