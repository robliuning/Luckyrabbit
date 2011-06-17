<?php
//updated in 9th June by rob
class Pment_Forms_CpSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','contractorId',array(
			'label'=>'请选择要添加的承包商:',
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'submit','submit',array(
			'ignore'=>true,
			'class'=>'btConfirmNf radius',
			'name'=>'submit'
			)
		);
	}
}
?>