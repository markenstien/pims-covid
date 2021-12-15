drop table if exists queueing;
create table queueing(
	id int(10) not null primary key auto_increment,
	number_decimal int(10),
	status enum('waiting' , 'serving' , 'completed' , 'skipped') default 'waiting',
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);