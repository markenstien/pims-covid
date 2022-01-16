<?php
	namespace Form;

	use Core\Form;
	load(['Form'] , CORE);

	class AddressForm extends Form
	{

		public function __construct()
		{
			parent::__construct();

			$this->name = 'address_form';

			$this->addBlockHouseNumber();
			$this->addStreet();
			$this->addBarangay();
			$this->addCity();
			$this->addZip();

			$this->customSubmit('Save Address');
		}

		public function addBlockHouseNumber()
		{
			$this->add([
				'type' => 'text',
				'name' => 'block_house_number',
				'required' => true,
				'options' => [
					'label' => 'Block and house number'
				],
				'class' => 'form-control'
			]);
		}

		public function addStreet()
		{
			$this->add([
				'type' => 'select',
				'name' => 'street',
				'options' => [
					'label' => 'Street',
					'option_values' => self::$_STREETS
				],
				'required' => true,
				'class' => 'form-control'
			]);
		}

		public function addCity()
		{
			$this->add([
				'type' => 'text',
				'name' => 'city',
				'required' => true,
				'options' => [
					'label' => 'City'
				],
				'value' => 'Quezon City',
				'class' => 'form-control'
			]);
		}

		public function addBarangay()
		{
			$this->add([
				'type' => 'text',
				'name' => 'barangay',
				'required' => true,
				'options' => [
					'label' => 'Barangay'
				],
				'class' => 'form-control',
				'value' => 'culiat'
			]);
		}

		public function addZip()
		{
			$this->add([
				'type' => 'text',
				'name' => 'zip',
				'required' => true,
				'options' => [
					'label' => 'Zip'
				],
				'value' => '1128',
				'class' => 'form-control'
			]);
		}


		public function addModule($module)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'module_key',
				'value' => $module,
			]);
		}

		public function addModuleId($module_id)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'module_id',
				'value' => $module_id
			]);
		}

		public function addRedirecTo($redirectTo)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'redirectTo',
				'value'=> $redirectTo
			]);
		}

		public function addAddressId($address_id)
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'address_id',
				'value' => $address_id
			]);
		}

		static $_STREETS = ['Anahaw', 'Admirable Ln', 'Amethyst', 'Aldrin', 'Allan Bean', 'Anderw', 'A. Limqueco', 'Armstrong', 'Avenue Maria', 'Borman', 'Casanova Dr Ext', 'Cassanova Dr', 'Cenacle Dr', 'Central Ave', 'Charity Ln', 'Charity St', 'Charles Conrad', 'Circumferential Rd 5', 'Collins', 'Congressional Ave Ext', 'Dela Paz', 'Demetria Reynado', 'Diamond', 'Dona Regina', 'Freedon Ln', 'G. Ge Jesus', 'Gen. S. Aquino', 'General Luna', 'Golden Lane Morning Star Heights', 'Hizon Dr', 'Hope St', 'Jade', 'Jasmine', 'Jose Carlos St', 'Justice Ln', 'Ledesma Court Street', 'Libyan St', 'Lopez Jaena', 'Lotus', 'Love St', 'Lovell', 'Macaya St', 'Magsaysay', 'Maria Felipe', 'Maria Manguiat', 'Mc Divitt', 'McDivitt', 'Metro Ave', 'Morning Star Dr', 'Mystic Rose Dr', 'Opal', 'Osmena', 'P. Quiambao', 'Palmera', 'Paz Isabel St', 'Paz Isabel St', 'Peace St', 'Peaceful Ln', 'Pines St', 'Prudent Ln', 'Pura Villanueva Kalaw', 'Renowned Ln', 'Robina', 'Roxas', 'Rufo Lane', 'Salvador Estrada', 'Salvi', 'San Agustin', 'San Ponciano', 'Santa Felicia', 'Santa Margarita', 'St Bernadette', 'Sta Lucia', 'Sunriser', 'T. Alonzo', 'T. Bugallon', 'Tandang Sora Ave', 'Temparence Ln', 'Teodoro M Kalaw', 'Teody III', 'Tulips', 'Tyrone', 'Unamed', 'Union Dr Ext', 'Valerio Kalaw', 'Valor Ln', 'Via Hilario', 'Via Ramgo', 'Viola', 'Visayas Ave', 'White', 'Windgate', 'Z&H'];


	}