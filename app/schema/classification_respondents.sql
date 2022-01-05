drop table if exists classification_respondents;
create table classification_respondents(
	id int(10) not null primary key auto_increment,
	record_id int(10),
	items text comment 'json-encoded',
	remarks varchar(100),
	created_at timestamp default now()
);

alter table classification_respondents
	add column points int(10);