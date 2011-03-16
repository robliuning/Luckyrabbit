<?php include 'tmp/header.php'; ?>
<link href="css/p_generalinfo.css" rel="stylesheet" type="text/css" />
<title>工程管理DEMO - 基本信息管理</title>
<body>
	<div id="p_id" class="hide">nav_generalinfo</div>
	<div id="s_id" class="hide">gi_gdzc</div>
	<?php include 'tmp/menu.php'; ?>
	<div id="contentWrapper">
	<div id="p_breadcrumb"></div>
	<div id="p_stage_sidebar">
		<?php include 'tmp/sidebars/nav_generalinfo_sidebar.php'?>
		<div id="p_content">
		<h1>基本信息管理 - 固定资产 - 总览</h1>
		<div class="p_msg">
			<h3>本页显示内容为固定资产基本信息总览</h3>
		</div>
			<div class="overall_tool">
				<div class="button_group">
					<div><input class="tbMedium tbtext" type="text" /></div>
					<div><a href="#"><img src="images/icons/functions/search.png"/><p>查询</p></a></div>	
					<div><a href="generalInfo_new.php"><img src="images/icons/functions/new.png"/><p>新建</p></a></div>
					<div><a href="#"><img src="images/icons/functions/delete.png"/><p>删除</p></a></div>
					<div><a href="generalInfo.php"><img src="images/icons/functions/refresh.png"/><p>显示全部</p></a></div>
					<div><a href="#"><img src="images/icons/functions/print.png"/><p>打印</p></a></div>	
					<div><a href="#"><img src="images/icons/functions/help.png"/><p>帮助</p></a></div>	
				</div><!-- end of button group -->
			</div><!-- end of overall tool -->
			<div class="overall_content">
				<?php include 'tmp/test/test_table_gi_gdzc.php'?>
			</div><!-- end of overall content -->
		</div><!-- end of p_content -->
	</div><!-- end of page stage -->
	</div><!-- end of contentWrapper -->
	<?php include 'tmp/footer.php'; ?>
</body>
