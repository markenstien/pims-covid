create table laboratory_results(
	id int(10) not null primary key auto_increment,
	reference varchar(100) not null,
	record_id int(10) not null,
	patient_id int(10) not null,
	doctor_id int(10) not null,
	date_requested date,
	date_reported date,

	abnormalities varchar(100),
	densities varchar(100),
	
	pneumonia boolean,
	rbc varchar(100),
	wbc varchar(100),
	color varchar(100),
	clarity varchar(100),

	ketones varchar(100),
	ova varchar(100),
	larva varchar(100),
	adult_forms varchar(100),


	meds varchar(100),

	remarks text,
	pathologist text,
	medical_technologist text,
	notes text,

	created_at timestamp default now()
);


alter table laboratory_results
	add column severity enum('mild' , 'moderate' , 'severe' , 'na') default 'na',
	add column quarantine enum('home' , 'hostpitalized' , 'na') default 'na';

alter table laboratory_results
	add column allergies varchar(100) after adult_forms;