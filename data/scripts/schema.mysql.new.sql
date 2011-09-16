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
	typeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50)
)ENGINE=InnoDb;

-- 资质类别表
CREATE TABLE ge_qualiftypes (
	typeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	serie char(20) NOT NULL,
	name char(50) NOT NULL
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

-- 固定资产类别表
CREATE TABLE ge_astypes (
	typeId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL
)ENGINE=InnoDb;

-- 创建机械设备类别层级关系索引表
CREATE TABLE ge_etype_xref (
	indexParent int(6) UNSIGNED NOT NULL,
	indexChild int(6) UNSIGNED NOT NULL,

	PRIMARY KEY (indexParent, indexChild)
)ENGINE=InnoDb;

-- 创建材料类别层级关系索引表
CREATE TABLE ge_mtype_xref (
	indexParent int(6) UNSIGNED NOT NULL,
	indexChild int(6) UNSIGNED NOT NULL,

	PRIMARY KEY (indexParent, indexChild)
)ENGINE=InnoDb;
/* 基本信息表创建完成 */


/* 工程管理表创建开始 */
-- 工程信息表
CREATE TABLE pm_projects (
	projectId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(100) NOT NULL,
	address char(200),
	status tinyint(2) UNSIGNED NOT NULL,
	structype char(50),
	level tinyint(3) UNSIGNED,
	amount numeric(12,2),
	purpose text,
	constrArea int(8) UNSIGNED,
	staffNo int(4) UNSIGNED,
	remark text,
	cTime timestamp
)ENGINE=InnoDb;

-- 工程进度信息表
CREATE TABLE pm_progresses (
	progressId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	stage tinyint(2) UNSIGNED NOT NULL,
	task text,
	startDate date,
	endDateExp date,
	periodExp int(4) UNSIGNED,
	endDateAct date,
	periodAct int(4) UNSIGNED,
	quality tinyint(2) UNSIGNED,
	remark text,
	cTime timestamp,
	
	INDEX(projectId, stage),

	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE
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

	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 进度照片表
CREATE TABLE pm_images (
	imageId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	stage tinyint(2) UNSIGNED NOT NULL,
	imageSN tinyint(2) UNSIGNED NOT NULL,
	name char(50) NOT NULL,

	INDEX(projectId, stage),

	FOREIGN KEY (projectId, stage) REFERENCES pm_progresses(projectId, stage) ON UPDATE CASCADE
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
	scontrType char(20) NOT NULL,
	scontrDetail text,
	quality char(10),
	startDateExp date,
	endDateExp date,
	periodExp int(4) UNSIGNED,
	startDateAct date,
	endDateAct date,
	periodAct int(4) UNSIGNED,
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

-- 承包商资质关系表
CREATE TABLE sc_contr_qualif (
	cqId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	contractorId int(6) UNSIGNED ZEROFILL NOT NULL,
	qualifTypeId int(6) UNSIGNED ZEROFILL NOT NULL,
	qualifGrade char(10),

	FOREIGN KEY (contractorId) REFERENCES sc_contractors(contractorId) ON UPDATE CASCADE,
	FOREIGN KEY (qualifTypeId) REFERENCES ge_qualiftypes(typeId) ON UPDATE CASCADE
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
	phoneNo char(20),
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
	status tinyint(2) UNSIGNED,

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

-- 供应商表
CREATE TABLE ge_vendors (
	venId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	type tinyint(2) UNSIGNED NOT NULL,
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	address char(200),
	remark text,
	cTime timestamp,

	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;


/* 工人管理表创建开始 */
-- 班组信息表
CREATE TABLE wm_teams (
	teamId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	contactId int(6) UNSIGNED NOT NULL,
	remark text,
	cTime timestamp
)ENGINE=InnoDb;

-- 工人信息表
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

-- 日工工资表
CREATE TABLE wm_wages (
	wagId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	amount numeric(12,2) UNSIGNED NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,

	FOREIGN KEY (workerId) REFERENCES wm_workers(workerId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 计划派工单表
CREATE TABLE wm_regulars (
	regId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	item text,
	number int(4) UNSIGNED,
	startDate date NOT NULL,
	endDate date NOT NULL,
	period int(4) UNSIGNED,
	budget numeric(12,2) UNSIGNED ,
	cost numeric(12,2) UNSIGNED,
	profit numeric(12,2),
	remark text,
	cTime timestamp,

	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 额外派工单表
CREATE TABLE wm_extras (
	extId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	period int(4) UNSIGNED,
	cost numeric(12,2) UNSIGNED,
	remark text,
	cTime timestamp,

	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 工人奖励表
CREATE TABLE wm_bonuses (
	bonId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,
	bonDate date,
	typeId int(6) UNSIGNED ZEROFILL NOT NULL,
	detail text,
	amount numeric(12,2) UNSIGNED,
	remark text,
	cTime timestamp,

	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (workerId) REFERENCES wm_workers(workerId) ON UPDATE CASCADE,
	FOREIGN KEY (typeId) REFERENCES ge_bontypes(typeId) ON UPDATE CASCADE
)ENGINE=InnoDb;

-- 工人扣款表
CREATE TABLE wm_penalties (
	penId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	projectId int(6) UNSIGNED ZEROFILL NOT NULL,
	workerId int(6) UNSIGNED ZEROFILL NOT NULL,
	penDate date,
	typeId int(6) UNSIGNED ZEROFILL NOT NULL,
	detail text,
	amount numeric(12,2) UNSIGNED,
	remark text,
	cTime timestamp,

	FOREIGN KEY (projectId) REFERENCES pm_projects(projectId) ON UPDATE CASCADE,
	FOREIGN KEY (workerId) REFERENCES wm_workers(workerId) ON UPDATE CASCADE,
	FOREIGN KEY (typeId) REFERENCES ge_pentypes(typeId) ON UPDATE CASCADE
)ENGINE=InnoDb;
/* 工人管理表创建完成 */


/* 固定资产管理表创建开始 */
CREATE TABLE as_assets (
	asId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name char(50) NOT NULL,
	type char(20) NOT NULL,
	spec char(50),
	unit char(20) NOT NULL,
	num int(4) NOT NULL,
	vendor char(50),
	remark text,
	cTime timestamp
)ENGINE=InnoDb;

CREATE TABLE as_depres (
	depId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	asId int(6) UNSIGNED ZEROFILL NOT NULL UNIQUE,
	sDate date NOT NULL,
	period tinyint(2) NOT NULL,
	oValue numeric(12,2) NOT NULL,
	residual numeric(12,2) NOT NULL,
	method char(20),
--	yRate tinyint(2),
--	yDepre numeric(12,2),
--	mRate tinyint(2),
--	mDepre numeric(12,2),
	status text,
	remark text,
	cTime timestamp,

	FOREIGN KEY (asId) REFERENCES as_assets(asId) ON UPDATE CASCADE
)ENGINE=InnoDb;
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
	startDate date NOT NULL,
	endDate date,
	period int(4) UNSIGNED,
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
	amount numeric(12,2) UNSIGNED,

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
	amount numeric(12,2) UNSIGNED,

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
	amount numeric(12,2) UNSIGNED,

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
	amount numeric(12,2) UNSIGNED,

	FOREIGN KEY (trsId) REFERENCES eq_transfers(trsId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (eqpId) REFERENCES eq_equipments(eqpId) ON UPDATE CASCADE	ON DELETE CASCADE
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
	amount numeric(12,2) UNSIGNED,

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
	amount numeric(12,2) UNSIGNED,

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
	amount numeric(12,2) UNSIGNED,

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
	amount numeric(12,2) UNSIGNED,

	FOREIGN KEY (trsId) REFERENCES mm_transfers(trsId) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (mtrId) REFERENCES mm_materials(mtrId) ON UPDATE CASCADE ON DELETE CASCADE
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
	pilot int(6) UNSIGNED ZEROFILL NOT NULL,
	user char(50),
	fuelCons numeric(5,2),
	pDate date,
	brand char(50),
	price numeric(12,2),
	remark text,
	cTime timestamp,

	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE,
	FOREIGN KEY (pilot) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE ve_insurances (
	insId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	veId int(6) UNSIGNED ZEROFILL NOT NULL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	total numeric(12,2) NOT NULL,
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (veId) REFERENCES ve_vehicles(veId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE ve_ins_spec (
	ispecId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	insId int(6) UNSIGNED ZEROFILL NOT NULL,
	spec char(50) NOT NULL,
	detail char(50),
	price numeric(12,2) NOT NULL,
	
	FOREIGN KEY (insId) REFERENCES ve_insurances(insId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE ve_drirecords(
	recordId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	veId int(6) UNSIGNED ZEROFILL NOT NULL,
	rYear int(4) NOT NULL,
	rMonth tinyint(2) NOT NULL,
	mileEarly int(8) NOT NULL,
	mileEnd int(8) NOT NULL,
	mile int(8) NOT NULL,
	remark text,
	
	FOREIGN KEY (veId) REFERENCES ve_vehicles(veId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE ve_repairs (
	repId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	veId int(6) UNSIGNED ZEROFILL NOT NULL,
	rDate date NOT NULL,
	reason text,
	detail text,
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	spot char(200),
	descr text,
	amount numeric(12,2) NOT NULL,
	insFlag tinyint(1) NOT NULL,
	indem numeric(12,2),
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (veId) REFERENCES ve_vehicles(veId) ON UPDATE CASCADE,
	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE ve_mtncs (
	mtnId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	veId int(6) UNSIGNED ZEROFILL NOT NULL,
	rDate date NOT NULL,
	detail text,
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	mile int(8) NOT NULL,
	amount numeric(12,2) NOT NULL,
	remark text,
	cTime timestamp,
	
	FOREIGN KEY (veId) REFERENCES ve_vehicles(veId) ON UPDATE CASCADE,
	FOREIGN KEY (contactId) REFERENCES em_contacts(contactId) ON UPDATE CASCADE
)ENGINE=InnoDb;

CREATE TABLE ve_verecords (
	recordId int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
	veId int(6) UNSIGNED ZEROFILL NOT NULL,
	prjFlag tinyint(1) NOT NULL,
	projectId int(6) UNSIGNED ZEROFILL,
	startDate date NOT NULL,
	endDate date NOT NULL,
	period int(4) UNSIGNED,
	route text,
	mileBf int(8) UNSIGNED NOT NULL,
	mileAf int(8) UNSIGNED NOT NULL,
	mile int(8),
	purpose text,
	contactId int(6) UNSIGNED ZEROFILL NOT NULL,
	user char(20) NOT NULL,
	mileRef int(8),
	amount numeric(12,2),
	remark text,
	cTime timestamp,

	FOREIGN KEY (veId) REFERENCES ve_vehicles(veId) ON UPDATE CASCADE
)ENGINE=InnoDb;


/* 触发器 */
-- 工程进度表 工期
delimiter //
CREATE TRIGGER t_period_progress_i BEFORE INSERT ON pm_progresses
FOR EACH ROW
BEGIN
	IF NEW.endDateExp IS NOT NULL AND NEW.startDate IS NOT NULL THEN
		SET NEW.periodExp = DATEDIFF(NEW.endDateExp,NEW.startDate) + 1;
	END IF;
	IF NEW.endDateAct IS NOT NULL THEN
		SET NEW.periodAct = DATEDIFF(NEW.endDateAct,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

delimiter //
CREATE TRIGGER t_period_progress_u BEFORE UPDATE ON pm_progresses
FOR EACH ROW
BEGIN
	IF NEW.endDateExp <> OLD.endDateExp OR NEW.startDate <> OLD.startDate THEN
		SET NEW.periodExp = DATEDIFF(NEW.endDateExp,NEW.startDate) + 1;
	END IF;
	IF NEW.endDateAct <> OLD.endDateAct OR NEW.startDate <> OLD.startDate THEN
		SET NEW.periodAct = DATEDIFF(NEW.endDateAct,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

-- 分包单 工期
delimiter //
CREATE TRIGGER t_period_subcontr_i BEFORE INSERT ON sc_subcontracts
FOR EACH ROW
BEGIN
	IF NEW.endDateExp IS NOT NULL AND NEW.startDateExp IS NOT NULL THEN
		SET NEW.periodExp = DATEDIFF(NEW.endDateExp,NEW.startDateExp) + 1;
	END IF;
	IF NEW.endDateAct IS NOT NULL AND NEW.startDateAct IS NOT NULL THEN
		SET NEW.periodAct = DATEDIFF(NEW.endDateAct,NEW.startDateAct) + 1;
	END IF;
END; //
delimiter ;

delimiter //
CREATE TRIGGER t_period_subcontr_u BEFORE UPDATE ON sc_subcontracts
FOR EACH ROW
BEGIN
	IF NEW.endDateExp <> OLD.endDateExp OR NEW.startDateExp <> OLD.startDateExp THEN
		SET NEW.periodExp = DATEDIFF(NEW.endDateExp,NEW.startDateExp) + 1;
	END IF;
	IF NEW.endDateAct <> OLD.endDateAct OR NEW.startDateAct <> OLD.startDateAct THEN
		SET NEW.periodAct = DATEDIFF(NEW.endDateAct,NEW.startDateAct) + 1;
	END IF;
END; //
delimiter ;

-- 计划派工单 工期
delimiter //
CREATE TRIGGER t_period_regular_i BEFORE INSERT ON wm_regulars
FOR EACH ROW
BEGIN
	IF NEW.endDate IS NOT NULL AND NEW.startDate IS NOT NULL THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

delimiter //
CREATE TRIGGER t_period_regular_u BEFORE UPDATE ON wm_regulars
FOR EACH ROW
BEGIN
	IF NEW.endDate <> OLD.endDate OR NEW.startDate <> OLD.startDate THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

-- 额外派工单 工期
delimiter //
CREATE TRIGGER t_period_extra_i BEFORE INSERT ON wm_extras
FOR EACH ROW
BEGIN
	IF NEW.endDate IS NOT NULL AND NEW.startDate IS NOT NULL THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

delimiter //
CREATE TRIGGER t_period_extra_u BEFORE UPDATE ON wm_extras
FOR EACH ROW
BEGIN
	IF NEW.endDate <> OLD.endDate OR NEW.startDate <> OLD.startDate THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

-- 设备租赁 天数
delimiter //
CREATE TRIGGER t_period_rent_i BEFORE INSERT ON eq_rents
FOR EACH ROW
BEGIN
	IF NEW.endDate IS NOT NULL AND NEW.startDate IS NOT NULL THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

delimiter //
CREATE TRIGGER t_period_rent_u BEFORE UPDATE ON eq_rents
FOR EACH ROW
BEGIN
	IF NEW.endDate <> OLD.endDate OR NEW.startDate <> OLD.startDate THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

-- 车辆使用记录 天数
delimiter //
CREATE TRIGGER t_period_verec_i BEFORE INSERT ON ve_verecords
FOR EACH ROW
BEGIN
	IF NEW.endDate IS NOT NULL AND NEW.startDate IS NOT NULL THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

delimiter //
CREATE TRIGGER t_period_verec_u BEFORE UPDATE ON ve_verecords
FOR EACH ROW
BEGIN
	IF NEW.endDate <> OLD.endDate OR NEW.startDate <> OLD.startDate THEN
		SET NEW.period = DATEDIFF(NEW.endDate,NEW.startDate) + 1;
	END IF;
END; //
delimiter ;

/*
-- 固定资产已使用年限
delimiter //
CREATE TRIGGER t_age_depre_i BEFORE INSERT ON as_depres
FOR EACH ROW
BEGIN
	SET NEW.age = TIMESTAMPDIFF(YEAR, NEW.sDate, CURDATE());
END; //
delimiter ;

delimiter //
CREATE TRIGGER t_age_depre_u BEFORE UPDATE ON as_depres
FOR EACH ROW
BEGIN
	SET NEW.age = TIMESTAMPDIFF(YEAR, NEW.sDate, CURDATE());
END; //
delimiter ;
*/