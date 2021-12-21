<?php 
	
	load(['ClassificationItemForm'] , APPROOT.DS.'form');
	use Form\ClassificationItemForm;

	class ClassificationItemController extends Controller
	{

		public function __construct()
		{
			$this->classification_item_form = new ClassificationItemForm();
			$this->model = model('ClassificationItemModel');
		}

		public function create()
		{
			$classification_id = request()->input('classification_id');

			if( isSubmitted() )
			{
				$post = request()->posts();
				
				$res = $this->model->create($post);

				if(!$res) {
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set( "Item Added");
				return redirect( _route('classification:show' , $classification_id) ); 
			}

			$this->data['title'] = ' Create Classification Item ';
			$this->data['classification_item_form'] = $this->classification_item_form;
			$this->data['classification_id'] = $classification_id;


			$this->data['classification_item_form']->addClassificationId( $classification_id );

			return $this->view('classification_item/create' , $this->data);
		}

		public function edit($id)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->save($post , $post['id']);

				if(!$res) {
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set( $this->model->getMessageString() );
			}

			$classification_item = $this->model->get($id);

			$this->data['classification_item'] = $classification_item;

			$this->classification_item_form->init([
				'url' => _route('classification-item:edit' , $classification_item->id)
			]);

			$this->classification_item_form->setValue('submit' , 'Save Classification Item');
			$this->classification_item_form->setValueObject( $classification_item );
			$this->classification_item_form->addId( $classification_item->id );

			$this->data['classification_item_form'] = $this->classification_item_form;
			$this->data['classification_id'] = $classification_item->classification_id;



			return $this->view('classification_item/edit' , $this->data);
		}
	}