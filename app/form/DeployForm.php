<?php 

	namespace Form;

	use Core\Form;

	load(['Form'] , CORE);

	class DeployForm extends Form
	{

		public function __construct()
		{
			parent::__construct();

			$this->name = 'deploy_form';

			$this->addHospital();
			$this->addDeploymentDate();
			$this->addAttendingPersonel();
			$this->addReleaseRemarks();
			$this->addRecordStatus();
			$this->addNotes();

			$this->customSubmit('Create Deployment');
		}

		public function addRecordId( $id )
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'record_id',
				'value' => $id
			]);
		}

		public function addHospital()
		{	
			$hospital_model = model('HospitalModel');
			$hospitals = $hospital_model->getAll();

			$hospitals = arr_layout_keypair($hospitals, ['id' , 'name']);

			$this->add([
				'type' => 'select',
				'name' => 'hospital_id',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Hospital',
					'option_values' => $hospitals
				],
				'attributes' => [
					'id' => 'id_hospital'
				]
			]);
		}

		public function addDeploymentDate()
		{
			$this->add([
				'type' => 'date',
				'name' => 'deployment_date',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Deployment Date',
				]
			]);
		}

		public function addAttendingPersonel( $user_id = null)
		{
			$user_model = model('UserModel');

			$users = $user_model->getAll([
				'where' => [
					'user_type' => [
						'condition' => 'in',
						'value'  => ['doctor', 'medical personel']
					]
				]
			]);
			$users = arr_layout_keypair($users , ['id' , 'first_name@last_name']);

			$this->add([
				'type' => 'select',
				'name' => 'attending_medical_personel_id',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Attending Medical Personel',
					'option_values' => $users
				],
				'value' => whoIs('id')
			]);
		}

		public function addReleaseRemarks()
		{
			$this->add([
				'type' => 'select',
				'name' => 'release_remarks',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Release Remarks',
					'option_values' => ['recovered' , 'deceased']
				]
			]);
		}

		public function addRecordStatus()
		{
			$this->add([
				'type' => 'select',
				'name' => 'record_status',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Record Status',
					'option_values' => ['completed','on-going','invalid','pending']
				],
				'value' => 'on-going'
			]);
		}

		public function addNotes()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'notes',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Notes',
				],
				'attributes' => [
					'rows' => 3
				]
			]);
		}
	}