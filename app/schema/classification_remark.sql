drop table if exists classification_remarks;
create table classification_remarks(
	id int(10) not null primary key auto_increment,
	points int(10) not null,
	remarks varchar(100),
	description text,
	color varchar(100),

	created_at timestamp default now() ON UPDATE now()
);