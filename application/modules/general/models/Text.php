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
		//admin login
		public static $text_loginFailed = "登录失败，用户名或登录密码错误。";

		//vehicle drirecord
		public static $text_vehicle_pilot_notFound = "错误: 请检查司机输入是否正确。";
		public static $text_vehicle_contact_notFound = "错误: 请检查车辆负责人输入是否正确。";
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
	}
?>