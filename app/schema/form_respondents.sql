drop table if exists form_respondents;
create table form_respondents(
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	form_id int(10) not null,
	user_id int(10) not null,
	form_detail text comment 'json encoded',
	items text comment 'json encode answers',

	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);