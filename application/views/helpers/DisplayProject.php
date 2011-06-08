<?php
class Zend_View_Helper_DisplayProject extends Zend_View_Helper_Abstract 
{
	public function displayProject ($project)
	{
			return'<div class="overall_content">
				<p class="subMenu slideMenu"><a id="btPro" class="subMenu_switch_close">工程详情</a></p>
				<table class="conTable">
					<colgroup>
						<col style="width:13%"></col>
						<col style="width:20%"></col>
						<col style="width:13%"></col>
						<col style="width:20%"></col>
						<col style="width:14%"></col>
						<col style="width:20%"></col>
					</colgroup>
					<tr>
						<td>工程名称: </td>
						<td>'.$project->getName().'</td>
						<td>工程状态: </td>
						<td>'.$project->getStatus().'</td>
						<td>结构类型: </td>
						<td>'.$project->getStructype().'</td>
					</tr>
				</table>
				<div class="hide" id="conPro">
				<table class="conTable">
					<colgroup>
						<col style="width:13%"></col>
						<col style="width:20%"></col>
						<col style="width:13%"></col>
						<col style="width:20%"></col>
						<col style="width:14%"></col>
						<col style="width:20%"></col>
					</colgroup>
					<tr>
						<td>工程地址: </td>
						<td>'.$project->getAddress().'</td>
						<td>层数: </td>
						<td>'.$project->getLevel().'</td>
						<td>合同工期(天): </td>
						<td>'.$project->getPeriod().'</td>
					</tr>
					<tr>
						<td>开工日期: </td>
						<td>'.$project->getStartDate().'</td>
						<td>项目经理: </td>
						<td><a class="lightbox" href="/employee/index/ajaxdisplay/id/'.$project->getContactId().'">'.$project->getContactName().'</a></td>
						<td>建设单位: </td>
						<td>'.$project->getConstructor().'</td>
					</tr>
					<tr>
						<td>工程承包单位: </td>
						<td>'.$project->getContractor().'</td>
						<td>监理单位: </td>
						<td>'.$project->getSupervisor().'</td>
						<td>设计单位: </td>
						<td>'.$project->getDesigner().'</td>
					</tr>
					<tr>
						<td>施工许可证编号: </td>
						<td>'.$project->getLicense().'</td>
						<td>合同金额(元人民币): </td>
						<td>'.$project->getAmount().'</td>
						<td>建筑面积(平方米): </td>
						<td>'.$project->getConstrArea().'</td>
					</tr>
					<tr>
						<td>备注: </td>
						<td colspan="5">'.$project->getRemark().'</td>
					</tr>
					<tr>
						<td>上次修改时间: </td>
						<td colspan="5">'.$project->getCTime().'</td>
					</tr>
				</table>
				</div>
			</div>';
	}
}
?>