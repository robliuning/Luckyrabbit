<?php
class Zend_View_Helper_DisplayFileSpec extends Zend_View_Helper_Abstract 
{
	public function displayFileSpec ($specs,$specId)
	{
		$display = '<div id="p_sidebar" class="p_sidebar_general"><ul>';
		foreach($specs as $spec)
		{
			if($spec->getSpecId() == $specId)
			{
				$display = $display.'<li><a class="labelSelected" href="/file/index/index/id/'.$spec->getSpecId().'">'.$spec->getName().'</a></li>';
				}
				else
				{
					$display = $display.'<li><a href="/file/index/index/id/'.$spec->getSpecId().'">'.$spec->getName().'</a></li>';
					}
			}
		$display = $display.'</ul></div>';
		return $display;
	}
}
?>