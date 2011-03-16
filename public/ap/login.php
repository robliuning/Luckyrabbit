<?php include 'tmp/header.php'; ?>
<link href="css/p_login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/p_login.js"></script>
<title>工程管理DEMO - 登陆</title>
<body>
	<div id="p_id" class="hide">nav_login</div>
	<div id="s_id" class="hide">none</div>
	<?php include 'tmp/menu.php'; ?>
	<div id="contentWrapper">
	<div id="p_stage">
		<div id="p_login">
			<div id="cap_top"></div>
			<div id="cap_body">
				<div id="panel_login">
					<div>
						<label>用户名</label>
						<input id="login_uname" type="text" class="tbLarge tbtext" value="" name="login_uname">
					</div>
					<div>
						<label>密码</label>
						<input id="login_pw" type="password" class="tbLarge tbtext" value="" name="login_pw">
					</div>
					<div class="submit clearfix">
						<p><a class="a_text lightbox" href="images/login/1.jpg">忘记密码？</a>或 <a class="a_text lightbox" href="images/login/2.jpg">帮助？</a></p>
						<a href="mainpage.php" class="btConfirm radius">登录</a>	
					</div>
				</div>
			</div><!-- end of cap_body -->
			<div id="cap_bottom"></div>
		</div><!-- end of page login -->
	</div><!-- end of page stage -->
	</div><!-- end of contentWrapper -->
	<?php include 'tmp/footer.php'; ?>
</body>