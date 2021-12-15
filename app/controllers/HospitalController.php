<?php 
	use Form\HospitalForm;
	load(['HospitalForm'] , APPROOT.DS.'form');

	class HospitalController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->data['form'] = new HospitalForm();
			$this->model = model('HospitalModel');
		}


		public function index()
		{
			$hospitals = $this->model->getAll();

			$this->data['hospitals'] = $hospitals;

			return $this->view('hospital/index' , $this->data);
		}

		public function create()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->model->create($post);

				if($res) {
					Flash::set( $this->model->getMessageString() );
					return redirect(_route('address:create' , null , [
						'module' => 'HOSPITAL',
						'id'     => $res,
						'redirect' => seal(_route('hospital:show' , $res))
					]));
				}
			}

			$this->data['page_title'] = 'Create Hospital';

			return $this->view('hospital/create' , $this->data);
		}

		public function show($id)
		{
			$hospital = $this->model->get($id);

			$this->data['hospital'] = $hospital;
			$this->data['page_title'] = $hospital->name;

			return $this->view('hospital/show' , $this->data);
		}
	}