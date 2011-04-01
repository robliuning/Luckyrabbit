/*create table em_employees(
	eid int(8) not null auto_increment primary key,
	email varchar(32) not null,
	name varchar(16) not null 
);*/


/*General*/
CREATE TABLE ge_posts(
	postId int(6) unsigned zerofill not null auto_increment primary key,
	name char(50) not null
);

CREATE TABLE ge_depts(
	deptsId int(6) unsigned zerofill not null auto_increment primary key,
	name char(50) not null
);

CREATE TABLE ge_duties(
	dutiesId int(6) unsigned zerofill not null auto_increment primary key,
	name char(50) not null
);

CREATE TABLE ge_titles(
	titlesId int(6) unsigned zerofill not null auto_increment primary key,
	name char(50) not null
);

CREATE TABLE ge_strutypes(
	struTypesId int(6) unsigned zerofill not null auto_increment primary key,
	name char(50) not null
);

/*Project*/


/*Employee*/
CREATE TABLE em_contacts(
	contactId int(6) unsigned zerofill not null auto_increment primary key,
	name char(50) not null,
	gender tinyint(2),
	birth date,
	idCard char(20),
	phoneNo char(20),
	otherContact char(100),
	address char(200),
	remark text
);
	    
CREATE TABLE em_employees(
	empId int(6) unsigned zerofill not null primary key,
	deptName char(50),
	dutyName char(50) not null,
	titleName char(50),
	status tinyint(2),

	foreign key (empId) references em_contacts(contactId)
);

CREATE TABLE em_cpp(
	contactId int(6) unsigned zerofill not null,
	postId int(6) unsigned zerofill not null,
	projectId int(6) unsigned zerofill not null,
	postType char(50),
	postCardId char(50),
	certId char(50),

	foreign key (contactId) references em_contacts(contactId),
	foreign key (postId) references ge_posts(postId),
	foreign key (projectId) references pm_projects(projectId),
	primary key (contactId, postId, projectId)
);


/*Contract*/



/*Worker*/



/*Asset*/



/*Equipment*/


/*Vehicle */
CREATE TABLE ve_vehicles(
	plateNo char(10) not null primary key,
	name char(50) not null,
	license char(50),
	personIC char(50),
	users char(20),
	fuelCons float(5,2),
	remark text
);
	    
CREATE TABLE ve_verecord(
	recordId int(6) unsigned zerofill not null primary key,
	name char(50),
	dateOfUse date,
	purpose char(50),
	milesBf int,
	milesAf int,
	pilot char(50),
	otherUsers char(100),
	remark text
);

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