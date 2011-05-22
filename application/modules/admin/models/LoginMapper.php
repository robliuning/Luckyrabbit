<?php

class Admin_Models_LoginMapper
{
	public function formValidator($form)
	{
		$emptyValidator = new Zend_Validate_NotEmpty();
		$emptyValidator->setMessage(General_Models_Text::$text_notEmpty);
		$form->getElement('username')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		$form->getElement('password')->setAllowEmpty(false)
								->addValidator($emptyValidator);
		return $form;
	}
}
?>