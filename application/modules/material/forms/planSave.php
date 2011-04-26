<?php
	/*
	Created by Meimo
	Date 2011.4.1
	*/
class Material_Forms_planSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'select', 'type', array(
			'label' => '计划类型: ',
			'multiOptions'=>array('日计划','周计划','月计划','年计划','项目计划','其他'),
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
     	$this->addElement(
			'text', 'dueDate', array(
			'label' => '计划到位时间: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
	  	$this->addElement(
			'select', 'projectId', array(
			'label' => '工程名称: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
    	$this->addElement(
			'text', 'applicId', array(
			'label' => '申报人: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'applicDate', array(
			'label' => '申报日期: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'approvId', array(
			'label' => '审批人: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	 	$this->addElement(
			'text', 'approvDate', array(
			'label' => '审批时间: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'total', array(
			'label' => '总金额: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
			'required' => false,			
			'class'=>'tbLarge tbText',
			'cols'=>40,
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