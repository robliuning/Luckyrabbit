<?php
	//in indexAction
		$this->view->module = "模块名称英文";
		$this->view->controller = "这个控制器名称"
		$this->view->modelName = "当前子模块中文";
	//in phtml
	//在table中隐藏３个控件保存上面３个值 如下例
		<thead>
			<th>#</th>
			<th><input id="modelName" type="text" class="hide" value="<?php echo $this->modelName ?>"></th>
			<th>班组名称</th>
			<th>负责人</th>
			<th>联系电话</th>
			<th>工人数量</th>
			<th><input id="module" type="text" class="hide" value="<?php echo $this->module ?>"></th>
			<th><input id="controller" type="text" class="hide" value="<?php echo $this->controller ?>"></th>
		</thead>

?>
