<?php
	/*
	Author: rob
	Date 2011.4.9
	*/
class Vehicle_Forms_VerecordSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'select', 'veId', array(
			'label' => '车牌号: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
     	$this->addElement(
			'text', 'startDate', array(
			'label' => '开始使用日期: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
	  	$this->addElement(
			'text', 'endDate', array(
			'label' => '结束使用日期: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
    	$this->addElement(
			'text', 'mile', array(
			'label' => '本次使用公里数: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'pilot', array(
			'label' => '驾驶员: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'otherUser', array(
			'label' => '其他使用人: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'textarea', 'purpose', array(
			'label' => '使用目的: ',
			'required' => false,
			'class'=>'tbText',
			'cols'=>60,
			'rows'=>5
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
			'required' => false,
			'class'=>'tbText',
			'cols'=>60,
			'rows'=>5
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