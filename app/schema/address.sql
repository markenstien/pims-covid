drop table if exists address;
create table address(
	id int(10) not null primary key auto_increment,
	block_house_number varchar(100),
	street varchar(100),
	city varchar(100),
	barangay varchar(100),
	zip varchar(100),
	created_at timestamp default now()
);

drop table if exists module_address;
create table module_address(
	id int(10) not null primary key auto_increment,
	module_key varchar(100),
	module_id int(10),
	address_id int(10),
	created_at timestamp default now()
);