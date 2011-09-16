<?php
class Zend_View_Helper_LoadErrorReport extends Zend_View_Helper_Abstract 
{
	public function loadErrorReport ()
	{
		return "<div id='floatTop_content'>
						<p class='ajax_slide'><a class='ajax_slide_button subMenu_switch_close'>系统问题反馈</a></p>
						<div class='hide ajax_slide_content'>
							<table>
								<colgroup>
									<col style='width:40%'></col>
									<col style='width:60%'></col>
								</colgroup>
								<tr>
									<td>问题类型: </td>
									<td><select id='ajax_typeId' name='ajax_typeId' class='tbMedium tbText'>
									</select></td>
								</tr>
								<tr>
									<td>所属模块: </td>
									<td><select id='ajax_modId' name='ajax_modId' class='tbMedium tbText'>
									</select></td>
								</tr>
								<tr>
									<td>问题描述: </td>
									<td><textarea id='ajax_description' name='ajax_description' class='tbText' cols='36' rows='8'></textarea></td>
								</tr>
								<tr>
									<td>解决优先级: </td>
									<td><select id='ajax_priority' name='ajax_priority' class='tbMedium tbText'>
										<option value='低'>低</option>
										<option value='中'>中</option>
										<option value='高'>高</option>
									</select></td>
								</tr>
								<tr>
									<td><p id='ajax_btEr' class='btConfirm radius ajax_slide_button_width'>递交问题</p></td>
									<td><p class='ajax_response'></p></td>
								</tr>
							</table>
						</div>
				</div>";
		}
}
?>