<?php
namespace Form;
use Core\Form;
load(['Form'] , CORE);

class LaboratoryForm extends Form
{

	public function __construct()
	{
		parent::__construct();

		$this->name = 'laboratory_form';

        $this->init([
            'url' => _route('lab:create')
        ]);

        $this->addDateRequested();
        $this->addDateReported();

        $this->addAbnormalities();
        $this->addDencities();
        $this->addRBC();

        $this->addWBC();
        $this->addUrineColor();
        $this->addKeytones();
        $this->addClarity();

        $this->addStoolOva();

        $this->addAllergies();
        $this->addRemarks();
        $this->addPneumonia();
        
        $this->addMedicine();
        $this->addPathologist();
        $this->addTechnologist();
        $this->addStoolLarva();

        $this->addPatientId();
		$this->addDoctorId();
		$this->addRecordId();
		$this->addSeverity();
		$this->addNotes();

        $this->customSubmit('Save Result');
	}

	public function addDateRequested()
	{
		$this->add([
			'type' => 'date',
			'name' => 'date_requested',
			'class' => 'form-control',
			'options' => [
				'label' => 'Date Requested'
			],
			'required' => true
		]);
	}


	public function addDateReported()
	{
		$this->add([
			'type' => 'date',
			'name' => 'date_reported',
			'class' => 'form-control',
			'options' => [
				'label' => 'Date Reported'
			],
			'required' => true
		]);
	}

	public function addAbnormalities()
	{
		$this->addText('abnormalities', 'Abnormalities');
	}


	public function addDencities()
	{
		$this->addText('densities' , 'Densities');
	}

	public function addRBC()
	{
		$this->addText('rbc' , 'Red Blood Cell Count (RBC)');
	}

	public function addWBC()
	{
		$this->addText('wbc' , 'White Blood Cell Count (WBC) ');
	}


	public function addUrineColor()
	{
		$this->add([
			'name' => 'color',
			'type' => 'select',
			'options' => [
				'label' => 'Urine Color',
				'option_values' => [
					'Clear' , 'Yellowish to Amber',
					'Red' , 'Pink' , 'Orange',
					'Blur' , 'Green' , 'Dark Brown',
					'Cloudy'
				]
			],

			'class' => 'form-control',
			'required' => true
		]);
	}

	public function addKeytones()
	{
		$this->addText('ketones' , 'Urine Keytones(millimoles per liter)');
	}

    public function addClarity()
    {
        $this->addTextArea('clarity' , 'Decribe Urine Clarity');
    }


    public function addNotes()
    {
        $this->addTextArea('notes' , 'Doctors Notes');
    }


	public function addStoolOva()
	{
		$this->addText('ova' , 'Ova');
	}

	public function addAllergies()
	{
		$this->addTextArea('allergies' , 'Allergies');
	}

	public function addMedicine()
	{
		$this->addTextArea('meds' , 'Medicines');
	}

    public function addRemarks()
    {
        $this->addTextArea('remarks' , 'Lab Result Remarks');
    }

	public function addPathologist()
	{
		$this->addText('pathologist' , 'Lab Result Pathologist');
	}

	public function addTechnologist()
	{
		$this->addText('medical_technologist' , 'Lab Result Medical Technologist');
	}

	public function addStoolLarva()
	{
		$this->addText('larva' , ' Larva');
	}


    public function addPatientId($id = null)
    {
        $this->add([
            'type' => 'hidden',
            'name' => 'patient_id',
            'value' => $id
        ]);
    }

    public function addDoctorId($id = null)
    {
        $this->add([
            'type' => 'hidden',
            'name' => 'doctor_id',
            'value' => $id
        ]);
    }

    public function addRecordId($id = null)
    {
        $this->add([
            'type' => 'hidden',
            'name' => 'record_id',
            'value' => $id
        ]);
    }

    public function addPneumonia()
    {
        $this->add([
            'type' => 'select',
            'name' => 'pneumonia',
            'options' => [
                'label' => 'Has Pneumonia?',
                'option_values' => [
                    '1' => 'Yes',
                    '0' => 'No'
                ]
            ],

            'class' => 'form-control',
            'required' => true
        ]);
    }

    public function addSeverity()
    {
        $this->add([
            'type' => 'select',
            'name' => 'severity',
            'options' => [
                'label' => 'Severity',
                'option_values' => [
                	'miled' , 'moderate' , 'severe'
                ]
            ],

            'class' => 'form-control',
            'required' => true
        ]);
    }

	public function addText($name , $label , $required = true)
	{
		$this->add([
			'name' => $name,
			'type' => 'text',
			'required' => true,
			'options' => [
				'label' => $label
			],
			'class' => 'form-control',
			'required' => $required
		]);
	}

	public function addTextArea($name , $label , $required = true)
	{
		$this->add([
			'name' => $name,
			'type' => 'textarea',
			'required' => true,
			'options' => [
				'label' => $label
			],
			'attributes' => [
				'rows' => 3
			],
			'class' => 'form-control',
			'required' => $required
		]);
	}
}