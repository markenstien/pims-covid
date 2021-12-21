drop table if exists classifications;
create table classifications(
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	severity_name varchar(100),
	name varchar(100),
	description text,
	is_active boolean default true,
	created_at timestamp default now()
);