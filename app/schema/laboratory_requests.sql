drop table laboratory_requests;
create table laboratory_requests(
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	record_id int(10),
	patient_id int(10) not null,
	date_requested date ,

	status enum('pending' , 'cancelled' , 'completed') default 'pending',
	notes text,
	

	created_by int(10),
	updated_by int(10),

	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);

alter table laboratory_requests
	add column result_id int(10);