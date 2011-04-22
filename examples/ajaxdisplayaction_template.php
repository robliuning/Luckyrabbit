//code in controller
<?php	
	public function ajaxdisplayAction()
	{
		$this->_helper->layout()->disableLayout();
   		$id = $this->_getParam('id',0);
    	if($id >0)
    	{
   		    $teams = new Worker_Models_TeamMapper();
   		    $team = new Worker_Models_Team();
   			$teams->find($id,$team);
   			$this->view->team = $team;
   			}
    		else
    		{
   				$this->_redirect('/worker');
   				}
		}
?>

//code in view file ajaxdisplay.phtml
<div id="ajaxMsgBox">
	<div id="ajaxMsgBox_vehicle">
		<?php
			$vehicle = $this->vehicle;
			echo $vehicle->getVeId()."<br/>".$vehicle->getPlateNo();		
		?>
	</div>
</div>