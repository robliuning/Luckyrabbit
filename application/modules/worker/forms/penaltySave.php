<?php
	/*
	Created by Meimo
	Date 2011.4.17
	*/
class Worker_Forms_penaltySave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'select', 'workerId', array(
			'label' => '工人姓名: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
     	$this->addElement(
			'select', 'projectId', array(
			'label' => '工程名称: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	  	$this->addElement(
			'text', 'penDate', array(
			'label' => '日期: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'select', 'typeId', array(
			'label' => '扣款类型: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'detail', array(
			'label' => '详情: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'amount', array(
			'label' => '金额: ',
			'required' => true,
			'class'=>'tbLarge tbText'
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