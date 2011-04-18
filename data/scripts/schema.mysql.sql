/* 基本信息表创建开始 */
-- 部门信息
CREATE TABLE ge_depts(
	deptId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50)
)ENGINE=InnoDb;

-- 职务信息
CREATE TABLE ge_duties(
	dutyId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50)
)ENGINE=InnoDb;

-- 职称信息
CREATE TABLE ge_titles(
	titleId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50)
)ENGINE=InnoDb;

-- 岗位信息
CREATE TABLE ge_posts(
	postId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50)
)ENGINE=InnoDb;

-- 结构类型表
CREATE TABLE ge_structypes (
	structypeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50)
)ENGINE=InnoDb;

-- 资质类别表
CREATE TABLE ge_qualiftypes (
	qualifTypeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	serie tinyint(2) UNSIGNED,
	name char(50)
)ENGINE=InnoDb;

-- 创建仓库工地表
CREATE TABLE ge_sites (
	siteId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL
)ENGINE=InnoDb;

-- 创建材料类别表
CREATE TABLE ge_mtrtypes (
	typeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL
)ENGINE=InnoDb;

-- 创建机械设备类别表
CREATE TABLE ge_eqptypes (
	typeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL
)ENGINE=InnoDb;

-- 创建奖励类型表
CREATE TABLE ge_bontypes (
	typeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL
)ENGINE=InnoDb;

-- 创建扣款类型表
CREATE TABLE ge_pentypes (
	typeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL
)ENGINE=InnoDb;


/* 基本信息表创建完成 */


/* 工程管理表创建开始 */
-- 工程信息表
CREATE TABLE pm_projects (
	projectId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(100) NOT NULL,
	address char(200),
	status tinyint(2),
	structype char(50),
	level tinyint(2),
	amount numeric(10,2),
	purpose text,
	constrArea int(9),
	staffNo int(4),
	remark text,
	cTime timestamp
)ENGINE=InnoDb;

-- 工程进度表
CREATE TABLE pm_progresses (
	progressId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	stage tinyint(2) UNSIGNED NOT NULL,
	task text,
	startDateExp date,
	endDateExp date,
	periodExp int,
	endDateAct date,
	periodAct int,
	quality tinyint(2) UNSIGNED,
	remark text,
	cTime timestamp,
	
	INDEX(projectId, stage),
	
	FOREIGN KEY (projectId) REFERENCES pm_projects (projectId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 总施工日志表
CREATE TABLE pm_projectlogs (
	pLogId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	logDate date NOT NULL,
	weather char(8),
	tempHi tinyint(2),
	tempLo tinyint(2),
	progress text,
	qualityPbl text,
	safetyPbl text,
	otherPbl text,
	relatedFile text,
	mMinutes text,
	changeSig text,
	material text,
	machine text,
	utility text,
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects (projectId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 进度照片表
CREATE TABLE pm_images (
	imageId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	stage tinyint(2) UNSIGNED NOT NULL,
	imageSN tinyint(2) NOT NULL,
	name char(50) NOT NULL,
	
	INDEX(projectId, stage),
	
	FOREIGN KEY (projectId, stage) REFERENCES pm_progresses (projectId, stage) ON UPDATE CASCADE
)ENGINE=InnoDb;
/* 工程管理表创建完成 */


/* 分包管理表创建开始 */
-- 承包商信息表
CREATE TABLE sc_contractors (
	contractorId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(100) NOT NULL,
	artiPerson char(50),
	licenseNo char(100),
	busiField text,
	phoneNo char(20),
	otherContact char(100),
	address char(200),
	remark text,
	cTime timestamp
)ENGINE=InnoDb;

-- 分包单表
CREATE TABLE sc_subcontracts (
	scontrId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	contractorId int(6) UNSIGNED ZEROFILL NOT NULL,
	scontrType tinyint(2) UNSIGNED NOT NULL,
	scontrDetail text,
	quality tinyint(2),
	startDateExp date,
	endDateExp date,
	periodExp int(4),
	startDateAct date,
	endDateAct date,
	periodAct int(4),
	brConContr text,
	brResContr text,
	brConSContr text,
	brResSContr text,
	warranty text,
	contrAmt numeric(12,2),
	consMargin numeric(12,2),
	prjMargin numeric(12,2),
	prjWarr numeric(12,2),
	remark text,
	cTime timestamp,

	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (contractorId) REFERENCES sc_contractors(contractorId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE sc_contr_qualif (
	cqId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contractorId int(6) UNSIGNED ZEROFILL NOT NULL,
	qualifSerie tinyint(2) UNSIGNED NOT NULL,
	qualifType char(50) NOT NULL,
	qualifGrade tinyint(2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (contractorId) REFERENCES sc_contractors(contractorId) ON UPDATE CASCADE
)ENGINE=InnoDb;
/* 分包管理表创建完成 */


/* 员工及岗位管理表创建开始 */
-- 通信录信息表
CREATE TABLE em_contacts (
	contactId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	gender tinyint(2),
	titleName char(50),
	birth date,
	idCard char(20),
	phoneNo int(20),
	otherContact char(100),
	address char(200),
	remark text,
	cTime timestamp
)ENGINE=InnoDb;

-- 公司员工基本信息表
CREATE TABLE em_employees (
	empId int(6) UNSIGNED ZEROFILL NOT NULL PRIMARY KEY,
	deptName char(50),
	dutyName char(50),
	status tinyint(2),
	
	FOREIGN KEY (empId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 人员岗位项目关系表
CREATE TABLE em_cpp (
	cppId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	postId int(6) UNSIGNED ZEROFILL NOT NULL,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	postCardId char(50),
	postType char(50),
	certId char(50),
	cTime timestamp,

	INDEX(contactId, postId, projectId),

	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (postId) REFERENCES ge_posts(postId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;
/* 员工及岗位信息管理表创建完成 */

-- 创建供应商表
CREATE TABLE ge_vendors (
	venId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	type tinyint(2) NOT NULL,
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	address char(200),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;


/* 工人管理表创建开始 */
CREATE TABLE wm_teams (
	teamId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	contactId int(6) NOT NULL,
	remark text,
	cTime timestamp
)ENGINE=InnoDb;

CREATE TABLE wm_workers (
	workerId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50),
	teamId int(6) UNSIGNED ZEROFILL NOT NULL,
	phoneNo char(20),
	address char(200),
	skill text,
	cert char(50),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (teamId) REFERENCES wm_teams(teamId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE wm_wages (
	wagId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	amount numeric(12,2) NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,
	
	FOREIGN KEY (workerId) REFERENCES wm_workers(workerId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE regulars (
	regId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	item text,
	number int(4),
	startDate date NOT NULL,
	endDate date NOT NULL,
	period int(4),
	budget numeric(12,2),
	cost numeric(12,2),
	profit numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE wm_extras (
	extId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	period int(4),
	cost numeric(12,2),
	remark text,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE wm_bonuses (
	bonId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,
	bonDate date,
	typeId int(6) UNSIGNED ZEROFILL NOT NULL,
	detail text,
	amount numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (workerId) REFERENCES wm_workers(workerId) ON UPDATE CASCADE,
	FOREIGN KEY (typeId) REFERENCES ge_bontypes(typeId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE wm_penalties (
	penId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,
	penDate date,
	typeId int(6) UNSIGNED ZEROFILL NOT NULL,
	detail text,
	amount numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (workerId) REFERENCES wm_workers(workerId) ON UPDATE CASCADE,
	FOREIGN KEY (typeId) REFERENCES ge_pentypes(typeId) ON UPDATE CASCADE
)ENGINE=InnoDb;
/* 工人管理表创建完成 */


/* 固定资产管理表创建开始 */
/* 固定资产管理表创建完成 */


/* 机械设备管理表创建开始 */
-- 创建机械设备信息表
CREATE TABLE eq_equipments (
	eqpId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	typeId int(6) UNSIGNED ZEROFILL NOT NULL,
	spec char(50),
	unit char(20) NOT NULL,
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (typeId) REFERENCES ge_eqptypes(typeId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备需求计划表
CREATE TABLE eq_plans (
	planId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	planType char(20) NOT NULL,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	dueDate date NOT NULL,
	applicId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicDate date NOT NULL,
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (applicId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备采购单表
CREATE TABLE eq_purchases (
	purId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	venId int(6) UNSIGNED ZEROFILL NOT NULL,
	buyerId int(6) UNSIGNED ZEROFILL NOT NULL,
	purDate date NOT NULL,
	planType char(20),
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	destId int(6) UNSIGNED ZEROFILL NOT NULL,
	freight numeric(12,2),
	invoice char(50),
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (venId) REFERENCES ge_vendors(venId) ON UPDATE CASCADE,
	FOREIGN KEY (buyerId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备租赁单表
CREATE TABLE eq_rents (
	renId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	venId int(6) UNSIGNED ZEROFILL NOT NULL,
	renRes text,
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	beginDate date NOT NULL,
	endDate date,
	planType char(20),
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	freight numeric(12,2),
	invoice char(50),
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (venId) REFERENCES ge_vendors(venId) ON UPDATE CASCADE,
	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备调拨单表
CREATE TABLE eq_transfers (
	trsId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	trsDate date NOT NULL,
	origId int(6) UNSIGNED ZEROFILL NOT NULL,
	destId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicDate date,
	planType char(20),
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (origId) REFERENCES ge_sites(siteId) ON UPDATE CASCADE,
	FOREIGN KEY (destId) REFERENCES ge_sites(siteId) ON UPDATE CASCADE,
	FOREIGN KEY (applicId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备需求计划关系表
CREATE TABLE eq_eqp_plan (
	mplanId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	planId int(6) UNSIGNED ZEROFILL NOT NULL,
	eqpId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (planId) REFERENCES eq_plans(planId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (eqpId) REFERENCES eq_equipments(eqpId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备采购关系表
CREATE TABLE eq_eqp_pur (
	mpurId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	purId int(6) UNSIGNED ZEROFILL NOT NULL,
	eqpId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED NOT NULL,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (purId) REFERENCES eq_purchases(purId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (eqpId) REFERENCES eq_equipments(eqpId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备租赁关系表
CREATE TABLE eq_eqp_exp (
	mplanId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	renId int(6) UNSIGNED ZEROFILL NOT NULL,
	eqpId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (renId) REFERENCES eq_rents(renId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (eqpId) REFERENCES eq_equipments(eqpId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备调拨关系表
CREATE TABLE eq_eqp_trs (
	mplanId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	trsId int(6) UNSIGNED ZEROFILL NOT NULL,
	eqpId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (trsId) REFERENCES eq_transfers(trsId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (eqpId) REFERENCES eq_equipments(eqpId) ON UPDATE CASCADE	ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建机械设备类别层级关系索引表
CREATE TABLE eq_type_xref (
	indexParent int(6) UNSIGNED NOT NULL,
	indexChild int(6) UNSIGNED NOT NULL,
	
	PRIMARY KEY (indexParent, indexChild)
)ENGINE=InnoDb;
/* 机械设备管理表创建完成 */


/* 材料管理表创建开始 */
-- 创建材料信息表
CREATE TABLE mm_materials (
	mtrId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	typeId int(6) UNSIGNED ZEROFILL NOT NULL,
	spec char(50),
	unit char(20) NOT NULL,
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (typeId) REFERENCES ge_mtrtypes(typeId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建材料需求计划表
CREATE TABLE mm_plans (
	planId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	planType char(20) NOT NULL,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	dueDate date NOT NULL,
	applicId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicDate date NOT NULL,
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (applicId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建材料采购单表
CREATE TABLE mm_purchases (
	purId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	venId int(6) UNSIGNED ZEROFILL NOT NULL,
	buyerId int(6) UNSIGNED ZEROFILL NOT NULL,
	purDate date NOT NULL,
	planType char(20),
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	destId int(6) UNSIGNED ZEROFILL NOT NULL,
	freight numeric(12,2),
	invoice char(50),
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (venId) REFERENCES ge_vendors(venId) ON UPDATE CASCADE,
	FOREIGN KEY (buyerId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建材料出库单表
CREATE TABLE mm_exports (
	expId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	expDate date NOT NULL,
	expType char(20) NOT NULL,
	destId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicDate date NOT NULL,
	planType char(20),
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (destId) REFERENCES ge_sites(siteId) ON UPDATE CASCADE,	
	FOREIGN KEY (applicId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建材料调拨单表
CREATE TABLE mm_transfers (
	trsId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	trsDate date NOT NULL,
	origId int(6) UNSIGNED ZEROFILL NOT NULL,
	destId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicId int(6) UNSIGNED ZEROFILL NOT NULL,
	applicDate date,
	planType char(20),
	approvId int(6) UNSIGNED ZEROFILL,
	approvDate date,
	total numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (origId) REFERENCES ge_sites(siteId) ON UPDATE CASCADE,
	FOREIGN KEY (destId) REFERENCES ge_sites(siteId) ON UPDATE CASCADE,
	FOREIGN KEY (applicId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (approvId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 创建材料需求计划关系表
CREATE TABLE mm_mtr_plan (
	mplanId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	planId int(6) UNSIGNED ZEROFILL NOT NULL,
	mtrId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (planId) REFERENCES mm_plans(planId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (mtrId) REFERENCES mm_materials(mtrId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建材料采购关系表
CREATE TABLE mm_mtr_pur (
	mpurId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	purId int(6) UNSIGNED ZEROFILL NOT NULL,
	mtrId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED NOT NULL,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (purId) REFERENCES mm_purchases(purId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (mtrId) REFERENCES mm_materials(mtrId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建材料出库关系表
CREATE TABLE mm_mtr_exp (
	mplanId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	expId int(6) UNSIGNED ZEROFILL NOT NULL,
	mtrId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (expId) REFERENCES mm_exports(expId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (mtrId) REFERENCES mm_materials(mtrId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建材料调拨关系表
CREATE TABLE mm_mtr_trs (
	mplanId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	trsId int(6) UNSIGNED ZEROFILL NOT NULL,
	mtrId int(6) UNSIGNED ZEROFILL NOT NULL,
	price numeric(12,2) UNSIGNED,
	quantity numeric(12,2) UNSIGNED NOT NULL,
	amount numeric(12,2) UNSIGNED NOT NULL,
	
	FOREIGN KEY (trsId) REFERENCES mm_transfers(trsId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (mtrId) REFERENCES mm_materials(mtrId) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDb;

-- 创建材料类别层级关系索引表
CREATE TABLE mm_type_xref (
	indexParent int(6) UNSIGNED NOT NULL,
	indexChild int(6) UNSIGNED NOT NULL,
	
	PRIMARY KEY (indexParent, indexChild)
)ENGINE=InnoDb;
/* 材料管理表创建完成 */


/* 车辆管理表创建开始 */
CREATE TABLE ve_vehicles (
	veId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	plateNo char(10) NOT NULL,
	name char(50) NOT NULL,
	color char(10),
	license char(50),
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	mainUser char(50),
	fuelCons numeric(5,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE ve_verecords (
	recordId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	veId int(6) UNSIGNED ZEROFILL NOT NULL,
	startDate date NOT NULL,
	endDate date,
	purpose text,
	mileBf int,
	mileAf int,
	mile int,
	pilot char(20) NOT NULL,
	user char(100),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (veId) REFERENCES ve_vehicles(veId) ON UPDATE CASCADE
)ENGINE=InnoDb;

	
