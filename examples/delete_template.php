<?php 
public function ajaxdeleteAction()
    {
		$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
   		$veId = $this->_getParam('id',0);
    	if($veId > 0)
    	{
    		$vehicles = new Vehicle_Models_VehicleMapper();
    		try{
    			$vehicles->delete($veId);
    			echo "s";
    			}
    			catch(Exception $e)
    			{
    				echo "f";
    				}
    		}
    		else
    		{
    			$this->_redirect('/vehicle');
    			}
    	}
?>