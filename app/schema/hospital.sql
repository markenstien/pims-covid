drop table if exists hospitals;
create table hospitals(
	id int(10) not null primary key auto_increment,
	name varchar(100),
	phone varchar(100),
	email varchar(100),
	contact_name varchar(100),
	address text,
	website varchar(100),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);