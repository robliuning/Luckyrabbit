<?php include 'tmp/header.php'; ?>
<link href="css/p_mainpage.css" rel="stylesheet" type="text/css" />
<title>工程管理DEMO - 首页</title>
<body>
	<div id="p_id" class="hide">nav_home</div>
	<div id="s_id" class="hide">none</div>
	<?php include 'tmp/menu.php'; ?>
	<div id="contentWrapper">
	<div id="p_breadcrumb"></div>
	<div id="p_stage_sidebar">
		<?php include 'tmp/sidebars/nav_home_sidebar.php'?>
		<div id="p_content">
		<h1>首页</h1>
		<div class="p_msg">
			<h3>欢迎登录工程管理系统Demo</h3>
			<p>版本 V0.1：本版本完成页面结构和UI设计，功能暂不可用。</p>
			<p>您可以通过左边的边栏阅读新的站内消息。</p>
			<p>您可以通过下面的管理项目图标分别进入相关管理界面。</p>
		</div>
		<div id="p_home_icons">
			<div class="home_icon"><a href="generalInfo.php"><h2>基本信息管理</h2><img src="images/icons/1.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>工人管理</h2><img src="images/icons/2.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>公司内部员工管理</h2><img src="images/icons/3.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>分包管理</h2><img src="images/icons/4.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>固定资产管理</h2><img src="images/icons/5.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>设备管理</h2><img src="images/icons/6.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>材料管理</h2><img src="images/icons/7.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>财务管理</h2><img src="images/icons/8.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>工程进度管理</h2><img src="images/icons/9.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>文件管理</h2><img src="images/icons/10.png"/></a></div>
			<div class="home_icon"><a href="#"><h2>工程统计</h2><img src="images/icons/11.png"/></a></div>
			</div><!-- end of home icons  -->
		</div>
	</div><!-- end of page stage -->
	</div><!-- end of contentWrapper -->
	<?php include 'tmp/footer.php'; ?>
</body>