drop table if exists record_form_respondents;
create table record_form_respondents(
	id int(10) not null primary key auto_increment,
	record_id int(10),
	form_respondent_id int(10),
	user_id int(10),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);