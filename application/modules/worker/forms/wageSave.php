<?php
	/*
	Created by Meimo
	Date 2011.4.17
	*/
class Worker_Forms_wageSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'text', 'name', array(
			'label' => '工人姓名: ',
			'required' => true,
			'class'=>'tbLarge tbText ac_workerName'//修改处
			)
		);
		
     	$this->addElement(
			'text', 'amount', array(
			'label' => '工资金额: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
	  	$this->addElement(
			'text', 'startDate', array(
			'label' => '开始日期: ',
			'required' => true,
			'class'=>'tbLarge tbText datepicker' //修改处
			)
		);
		$this->addElement(
			'text', 'endDate', array(
			'label' => '结束日期: ',
			'required' => true,
			'class'=>'tbLarge tbText datepicker' //修改处
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
			'text', 'workerId', array(
			'required' => true,
			'class'=>'hide ac_workerId'//修改处
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