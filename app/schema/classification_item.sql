
drop table if exists classification_items;
create table classification_items(
	id int(10) not null primary key auto_increment,
	classification_id int(10),
	label varchar(100),
	compare_to text,
	comparison varchar(50),
	points int(10),
	start_number decimal(10,2),
	end_number decimal(10,2),
	description text,
	order_num smallint,
	created_at timestamp default now()
);
