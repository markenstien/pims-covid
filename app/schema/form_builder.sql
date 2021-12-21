drop table if exists form_items;
create table form_items (
	id int(10) not null primary key auto_increment,
	form_id int(10),
	label varchar(100) not null,
	type enum('date' , 'dropdown' , 'short answer' , 'long answer') default 'short answer',
	default_value text,
	item_description text,
	options text ,
	attributes text,
	created_at timestamp default now()
);


drop table if exists forms;
create table forms (
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	name varchar(100),
	description text,
	created_at timestamp default now()
);