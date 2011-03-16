<<<<<<< HEAD
create table cont_contacts (
	contId int(8) not null auto_increment primary key,
	name varchar(16) not null,
	gender boolean,
	age int(2),
	idCard int(16),
	phone int(8),
	otherCont varchar(16),
	address varchar(16),
	remark varchar(32) 
);

create table pm_projects (
	prjId int(8) not null auto_increment primary key,
	name varchar(16) not null,
	address varchar(16),
	status int(2) not null,
	prjType varchar(16),
	layer int(2),
	purpose varchar(16),
	amount int(8),
	area int(8),
	mngr varchar(16) not null,
	techMngr varchar(16) not null,
	qaMngr varchar(16) not null,
	safetyMngr varchar(16) not null,
	quantity int(8),
	remark varchar(32)
);

create table pm_posts (
	poId int(8) not null auto_increment primary key,
	name varchar(16) not null,
	certName varchar(16) not null,
	certNo varchar(16) not null,
	certLevel varchar(8),
	remark varchar(32)
);

create table contacts_projects_posts (
	prjId int(8),
	contId int(8),
	poId int(8),
	primary key(priId, contId, poId),
	foreign key(prjId) references pm_projects(prjId),
	foreign key(contId) references cont_contacts(contId),
	foreign key(poId) references pm_posts(poId)
);

create table pm_postnames (
	poName varchar(16) primary key
);

create table pm_prjtypes (
	prjType varchar(16) primary key
};

create table pm_prjTasks (
	Id int(8) not null auto_increment primary key,
	prjname varchar(16) not null,
	stage varchar(16),
	name varchar(16) not null,
	mngr varchar(16) not null,
	sTime time, 
	eTime time,
	status int(2),
	quality int(2),
	approver varchar(16),
	taskRefid int(8) auto_increment,
	remark varchar(32)
);

create table pm_prjlogs (
	ID int(8) not null auto_increment primary key,
	prjName varchar(16) not null,
	logDate date,
	weather varchar(16),
	temp int(2),
	progress varchar(8),
	problem varchar(32),
	qaProb varchar(32),
	saProb varchar(32),
	relatedFiles varchar(32),
	meetingMemo varchar(32),
	changeSig varchar(32),
	material varchar(32),
	equip varchar(32),
	machine varchar(32),
	waterElec varchar(32)
);

create table pm_teamlogs (
	logID int(8) not null auto_increment primary key,
	teamName varchar(16) not null,
	dispatchNo int(16),
	quantity int(8),
	mngr varchar(16),
	presentQty int(8),
	subPrj varchar(32),
	constPart varchar(32),
	status varchar(32)
);

create table pm_picref (
	taskRefid int(8),
	picOne varchar(32),
	picTwo varchar(32),
	picThree varchar(32),
	picFour varchar(32),
	picFive varchar(32),
	picSix varchar(32),
	picSeven varchar(32),
	picEight varchar(32),
	picNine varchar(32),
	picTen varchar(32)
);
=======
/*create table em_employees(
	eid int(8) not null auto_increment primary key,
	email varchar(32) not null,
	name varchar(16) not null 
);*/


/*General*/


/*Project*/


/*Employee*/




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
>>>>>>> 85d547cc0d15876d058c679250341bbe50026677
