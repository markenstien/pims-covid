<?php 
	
	use Form\ClassificationRemarkForm;
	load(['ClassificationRemarkForm'] , APPROOT.DS.'form');

	class ClassificationRemarksController extends Controller
	{	

		public function __construct()
		{
			$this->model = model('ClassificationRemarkModel');
			$this->form = new ClassificationRemarkForm();
		}

		public function index()
		{
			$this->data['remarks'] = $this->model->getAssoc('remarks');
			return $this->view('classification_remark/index' , $this->data);
		}

		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post);

				if(!$res) {
					Flash::set("Something went wrong");
					return request()->return();
				}

				Flash::set( " Remarks {$post['remarks']} has been create" );
				return redirect( _route('remarks:index') );
			}

			$this->data['form'] = $this->form;
			$this->data['title'] = " Classification Remark ";

			return $this->view('classification_remark/create' , $this->data);
		}

		public function edit( $id )
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->save($post , $id);

				if(!$res) {
					Flash::set("Something went wrong");
					return request()->return();
				}

				Flash::set( " Remarks {$post['remarks']} has been updated" );
				return redirect( _route('remarks:index') );
			}

			$remark = $this->model->get($id);

			$this->form->init(['url' => _route('remarks:edit' , $id) ]);
			$this->form->setValueObject( $remark );
			$this->form->setValue('submit' , 'Edit remark');

			$this->data['form'] = $this->form;
			$this->data['title'] = " Classification Remark ";

			return $this->view('classification_remark/create' , $this->data);
		}
	}