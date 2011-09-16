<?php
	class General_Models_Text
	{
		//global
		public static $text_searchErrorNr = '错误: 没有找到符合条件的结果。';
		public static $text_searchErrorNi = '错误: 请输入搜索关键字。';
		public static $text_cpp_exist = "该岗位信息已经存在。";
		public static $text_save_success = "保存成功，请输入下一条数据。";
		public static $text_recordExists = "错误: 本记录已经存在，请检查。";
		public static $text_notInt = "数字不正确";
		public static $text_notDate = "日期不正确";
		public static $text_notEmpty = "本项不能为空";
		public static $text_notEmpty_part = "不能为空";
		public static $text_numeric_part = "必须为数字";
		public static $text_numeric_all = "预算部核量,单价和合价输入必须为数字";
		public static $text_notEmpty_all = "规格型号,预算部核量,控制价,控制价合价输入不能为空";
		
		public static $text_date_startEndError = "结束日期必须为开始日期之后。";
		public static $text_date_exist = "输入的时间已经存在。";
		
		//pment subcontractor
		public static $text_date_startEndError_sub_exp = "预计完成日期必须为预计进场日期之后。";
		public static $text_date_startEndError_sub_act = "实际完成日期必须为实际进场日期之后。";

		
		//admin login
		public static $text_loginFailed = "登录失败，用户名或登录密码错误。";

		//vehicle drirecord
		public static $text_vehicle_pilot_notFound = "错误: 请检查司机输入是否正确。";
		public static $text_vehicle_contact_notFound = "错误: 请检查姓名输入是否正确。";
		public static $text_vehicle_plateNo_length = "车牌号长度错误";
		public static $text_drirecord_no_mile = "无记录";
		//vehicle repair
		public static $text_repair_indem_true = "出险";
		public static $text_repair_indem_false = "未出险";
		public static $text_repair_contact_notFound = "错误: 请检查责任人输入是否正确。";
		//vehicle verecord
		public static $text_verecord_prjFlag_true = "项目用车";
		public static $text_verecord_prjFlag_false = "非项目用车";
		public static $text_verecord_contact_notFound = "错误: 请检查用(派)车人输入是否正确。";
		public static $text_verecord_projectId_wrong = "错误: 请选择项目。";
		
		//system user
		public static $text_system_user_length = "错误: 密码的长度需在6-12位之间.";
		public static $text_system_user_password_differ = "错误: 两次输入的密码不相同.";
		public static $text_system_user_contact_notFound = "错误: 真实姓名应从已存公司员工中选择.";
		public static $text_system_user_username_ocuppied = "错误: 输入的用户名已被使用.";
		public static $text_system_user_contactId_ocuppied = "错误: 输入的真实姓名已被使用.";
		public static $text_system_user_password_old_wrong = "错误: 输入的旧密码错误.";

		//pment mplan
		public static $text_mplan_apply_sucess = "材料计划提交成功,已进入审批流程.";
		public static $text_mplan_apply_failed = "材料计划提交失败,无材料内容.";
		public static $text_mplan_mapprove_validate_reviewer = "需所有核验人核验后,审批才能完成";
		public static $text_mplan_mapprove_complete_message_title = "材料计划审批通过" ;
		public static $text_mplan_mapprove_complete_message_content = "您提交的材料计划已经审批完成.";
		public static $text_mplan_mapprove_return_message_title = "材料计划已退回预算部重审";
		public static $text_mplan_mapprove_return_message_content = "您提交的材料月计划被材料部退回修改.";
		public static $text_mplan_material_add_sucess = "新材料添加成功!";
		public static $text_mplan_mfinal_sucess = '采购信息添加成功';
		//public static
		//public static
		
		//pment validation message 
		public static $text_mplan_validation_message_title = "新的材料月计划等待核验";
		public static $text_mplan_validation_message_content = "有新的材料月计划信息需要您的核验,点击下面链接,进入核验页面.";
		public static $text_mplan_validation_sucess = "材料月计划核验成功.";
		public static $text_mplan_validation_wrong_password = "核验人密码不正确!.";

	}
?>