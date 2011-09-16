<?php
//controller
		$this->_loadProject();
		$this->_pushLocations();
		$this->_loadMenu();
		$this->_loadSidebar();
		$this->_userAccess();
	//index action
		$this->_pushFuncs();
//phtml
		$arrayFuncs = $this->arrayFuncs;

	$this->headTitle(' - '.$this->modCName.' - '.$this->sidName);

	<h1><?php echo $this->modCName.' - '.$this->sidName.' - '.$this->actCName?></h1>

					<?php if($arrayFuncs['add'] == 1):?>
					<?php endif;?>
					
					<?php if($arrayFuncs['ajaxdelete'] == 1):?>
					<?php endif;?>
					
					<?php if($arrayFuncs['ajaxpdf'] == 1):?>
					<?php endif;?>
					
						<?php if($arrayFuncs['edit'] == 1):?>
						<?php endif;?>
//sidebarr
		<?php foreach($this->arraySidebars as $sidebar):?>
			<?php if($sidebar->getConName() == 'mstprg'):?>
				<li class="slideMenu"><a id ="btPrg">工程进度信息</a>
					<ul class="hide" id="conPrg">
						<li id="mstprg"><a href="/pment/mstprg">总进度计划</a></li>
						<li id="monprg"><a href="/pment/monprg">月进度计划</a></li>
						<li id="wkprg"><a href="/pment/wkprg">周进度计划</a></li>
						<li id="plog"><a href="/pment/plog">工程日志</a></li>
					</ul>
				</li>
			<?php elseif($sidebar->getConName() == 'tech'):?>
				<li class="slideMenu"><a id="btSafe">安全施工信息</a>
					<ul class="hide" id="conSafe">
						<li id="tech"><a href="/pment/tech">技术交底信息</a></li>
						<li id="training"><a href="/pment/training">安全培训信息</a></li>
						<li id="measure"><a href="/pment/measure">安全措施信息</a></li>
					</ul>
				</li>
			<?php elseif($sidebar->getConName() == 'cp'):?>
				<li class="slideMenu"><a id="btContractor">工程分包信息</a>
					<ul class="hide" id="conContractor">
						<li id="cp"><a href="/pment/cp">工程承包商信息</a></li>
						<li id="subcontract"><a href="/pment/subcontract">工程分包单信息</a></li>
					</ul>
				</li>
			<?php elseif($sidebar->getConName() == 'mplan'):?>
				<li class="slideMenu"><a id="btMaterial">工程材料信息</a>
					<ul class="hide" id="conMaterial">
						<li id="mplan"><a href="/pment/mplan">材料计划审批</a></li>
						<li><a href="/pment/import">材料收料信息</a></li>
						<li><a href="/pment/export">材料发料信息</a></li>
					</ul>
				</li>
			<?php elseif($sidebar->getConName() != 'monprg' && $sidebar->getConName() != 'wkprg' && $sidebar->getConName() != 'plog' && $sidebar->getConName() != 'subcontract' && $sidebar->getConName() != 'import' && $sidebar->getConName() != 'export' && $sidebar->getConName() != 'training' && $sidebar->getConName() != 'measure'):?>
				<li id="<?php echo $sidebar->getConName()?>"><a href="/<?php echo $sidebar->getModEName()?>/<?php echo $sidebar->getConName()?>"><?php echo $sidebar->getSidName()?></a></li>
			<?php endif;?>
		<?php endforeach;?>
?>