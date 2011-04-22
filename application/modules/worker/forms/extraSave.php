<?php
	/*
	Created by Meimo
	Date 2011.4.17
	*/
class Worker_Forms_extraSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'text', 'workerId', array(
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
			'text', 'startDate', array(
			'label' => '开始日期: ',
			'required' => true,
			'class'=>'tbLarge tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'endDate', array(
			'label' => '结束日期: ',
			'required' => true,
			'class'=>'tbLarge tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'period', array(
			'label' => '工期: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'cost', array(
			'label' => '派工费用: ',
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