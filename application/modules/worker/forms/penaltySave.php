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
			'text', 'name', array(
			'label' => '��������: ',
			'required' => true,
			'class'=>'tbLarge tbText ac_workerName'
			)
		);
		
     	$this->addElement(
			'select', 'projectId', array(
			'label' => '��������: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	  	$this->addElement(
			'text', 'penDate', array(
			'label' => '����: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'select', 'typeId', array(
			'label' => '�ۿ�����: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'detail', array(
			'label' => '����: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'amount', array(
			'label' => '���: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);					
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '��ע: ',
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
			'class'=>'hide ac_workerId'
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