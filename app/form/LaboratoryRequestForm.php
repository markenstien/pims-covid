<?php 
	namespace Form;

	use Core\Form;
	load(['Form'] , CORE);


	class LaboratoryRequestForm extends Form
	{

		public function __construct()
		{
			parent::__construct();

			$this->name = 'laboratory_request_form';


			$this->init(['url' => _route('lab-request:create') ]);

			$this->addRecordId();
			$this->addPatientId();
			$this->addDateRequested();
			$this->addStatus();
			$this->addNotes();
			$this->addCreatedBy();
			$this->addUpdatedBy();

			$this->customSubmit('Send Request');
		}

		public function addRecordId($value = null)
		{
			$this->add([
				'name' => 'record_id',
				'type' => 'hidden',
				'value' => $value
			]);
		}

		public function addPatientId($value = null)
		{
			$this->add([
				'name' => 'patient_id',
				'type' => 'hidden',
				'value' => $value
			]);
		}

		public function addDateRequested()
		{
			$this->add([
				'name' => 'date_requested',
				'type' => 'date',
				'options' => [
					'label' => 'Date Requested',
				],

				'required' => true,

				'class' => 'form-control',
				'requried' => true
			]);
		}

		public function addStatus()
		{
			$this->add([
				'name' => 'status',
				'type' => 'select',
				'options' => [
					'label' => 'Date Requested',
					'option_values' => [
						'pending' , 'cancelled' ,'completed'
					]
				],
				'class' => 'form-control',
				'requried' => true
			]);
		}

		public function addNotes()
		{
			$this->add([
				'name' => 'notes',
				'type' => 'textarea',
				'options' => [
					'label' => 'Notes For Medical Personels',
				],

				'class' => 'form-control',
				'requried' => true
			]);
		}

		public function addCreatedBy( $value = null )
		{
			$this->add([
				'name' => 'created_by',
				'type' => 'hidden',
				'value' => $value
			]);
		}

		public function addUpdatedBy( $value = null)
		{
			$this->add([
				'name' => 'created_at',
				'type' => 'hidden',
				'value' => $value
			]);
		}
	}