create table patient_records(
	id int(10) not null primary key auto_increment,
	blood_presure_num int(10),
	temperature_num int(10),
	pulse_rate_num int(10),
	respirator_rate_num int(10),
	height_num int(10),
	weight_num int(10),
	oxygen_level_num int(10),

	is_fever boolean,
	is_headache boolean,
	is_body_pains boolean,
	is_sore_throat boolean,
	is_diarrhea boolean,
	is_lost_of_taste_smell boolean,
	is_dificulty_breathing boolean,
	
	date date,
	user_id int(10),
	created_by int(10),
	updated_by int(10),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now(),
	completion_status enum('pending' , 'finished' , 'invalid') 
);

alter table patient_records
	add column time time after date;

alter table patient_records
	add column reference varchar(100) after id;


update patient_records set reference = '123123';

alter table patient_records
	add column doctors_approval int(10),
	add column is_deployed boolean default false,
	report_status enum('completed','on-going','invalid','pending') default 'pending';
