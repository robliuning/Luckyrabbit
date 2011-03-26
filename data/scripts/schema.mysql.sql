/*create table em_employees(
	eid int(8) not null auto_increment primary key,
	email varchar(32) not null,
	name varchar(16) not null 
);*/


/*General*/


/*Project*/


/*Employee*/
CREATE TABLE em_employees (
	empId int(4) zerofill not null auto_increment primary key,
	name char(50) not null,
	gender tinyint,
	age tinyint,
	deptName char(50),
	dutyName char(50),
	titleName char(50),
	idCard char(20),
	phone char(20),
	otherContact char(20),
	address char(100),
	status tinyint,
	remark text
)

CREATE TABLE ge_depts (
	deptId int unsigned not null auto_increment primary key,
	name char(50)
)

CREATE TABLE ge_duties (
	dutyId int unsigned not null auto_increment primary key,
	name char(50)
)

CREATE TABLE ge_titles (
	titleId int unsigned not null auto_increment primary key,
	name char(50)
)

/*Contract*/



/*Worker*/



/*Asset*/



/*Equipment*/



/*Material*/



/*Finance*/



/*Moneyapply*/



/*Document*/



/*System*/



/*Admin*/
CREATE TABLE global_users(
	id int not null auto_increment primary key,
	username varchar(50) unique not null,
	password varchar(32) null,
	password_salt varchar(32) null,
	real_name varchar(150) NULL
)