<?php
	/*
	Created by Meimo
	Date 2011.4.17
	*/
class Worker_Forms_regularSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'select', 'projectId', array(
			'label' => '���̱��: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
     	$this->addElement(
			'text', 'item', array(
			'label' => '�ɹ���Ŀ: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	  	$this->addElement(
			'text', 'number', array(
			'label' => '�ɹ�����: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'startDate', array(
			'label' => '��ʼ����: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'endDate', array(
			'label' => '��������: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'period', array(
			'label' => '����: ',
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