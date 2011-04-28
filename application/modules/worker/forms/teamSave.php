<?php
	/*
	Created by Meimo
	Date 2011.4.17
	*/
class Worker_Forms_teamSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'text', 'name', array(
			'label' => '班组名称: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
     	$this->addElement(
			'text', 'contactName', array(
			'label' => '负责人: ',
			'required' => true,
			'class'=>'tbLarge tbText ac_contactName'
			)
		);
		
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
			'required' => false,
			'class'=>'tbText',
			'cols'=>60,
			'rows'=>20
			)
		);
		
    	$this->addElement(
    		'submit','submit',array(
    		'ignore'=>true,
    		'class'=>'btConfirm radius',
    		'name'=>'submit'
    		)
    	);
    	
    	$this->addElement(
    		'submit','submit2',array(
    		'ignore'=>true,
    		'class'=>'btConfirm radius',
    		'name'=>'submit'
    		)
    	);
    	
    	$this->addElement(
			'text', 'contactId', array(
			'required' => true,
			'class'=>'hide ac_contactId'
			)
		);
    	    	
    	$this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data'=>'HtmlTag'),
            array('tag'=>'td','class'=>'element')),
            array('Label',array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr')),
   		 ));

		$this->setDecorators(array(
            'FormElements',
            array('HtmlTag',array('tag'=>'table')),
            'Form'
        ));
    }
}

?>