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
		<h1>基本信息管理 - 固定资产 - 新建</h1>
		<div class="p_msg">
			<h3>本页显示内容为添加新的固定资产基本信息</h3>
		</div>
		<div class="overall_tool">
				<div class="button_group">
					<div><a href="#"><img src="images/icons/functions/batch.png"/><p>批量</p></a></div>	
					<div><a href="generalInfo_new.php"><img src="images/icons/functions/empty.png"/><p>清空</p></a></div>
					<div><a href="#"><img src="images/icons/functions/save.png"/><p>保存</p></a></div>
					<div><a href="generalInfo.php"><img src="images/icons/functions/help.png"/><p>帮助</p></a></div>
					<div><a href="#"><img src="images/icons/functions/back_home.png"/><p>返回</p></a></div>	
				</div><!-- end of button group -->
			</div><!-- end of overall tool -->
			<div class="overall_content">
				<table>
					<colgroup>
						<col style="width:20%"></col>
						<col style="width:30%"></col>
						<col style="width:20%"></col>
						<col style="width:30%"></col>
					</colgroup>
					<tr>
						<td>资产编号</td>
						<td><input type="text" class="tbLarge tbtext" disabled="disabled" value="ZC-0002"></td>
						<td>资产名称</td>
						<td><input type="text" class="tbLarge tbtext"></td>
					</tr>
					<tr>
						<td>单位</td>
						<td><input type="text" class="tbLarge tbtext"></td>
						<td>规格型号</td>
						<td><input type="text" class="tbLarge tbtext"></td>
					</tr>
					<tr>
						<td>生产厂家</td>
						<td><input type="text" class="tbLarge tbtext"></td>
						<td>备注</td>
						<td rowspan="3"><input type="text" class="tbLarge tbtext"></td>
					</tr>
				</table>
			</div><!-- end of overall content -->
		</div>
	</div><!-- end of page stage -->
	</div><!-- end of contentWrapper -->
	<?php include 'tmp/footer.php'; ?>
</body>