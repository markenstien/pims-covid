drop table if exists deployments;
create table deployments(
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	type enum('hospital' , 'home-qurantine'),
	record_id int(10),
	patient_id int(10),
	hospital_id int(10),
	deployment_date date,
	attending_medical_personel_id int(10),
	is_released boolean default false,
	release_remarks enum('recovered' , 'deceased'),
	created_by int(10),
	notes text,
	record_status enum('completed','on-going','invalid','pending') default 'pending',
	created_at timestamp default now()
);

