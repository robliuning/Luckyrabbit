<?php
	/*
	Created by Meimo
	Date of creation 4.1.2011
	Completion date
	reviewed: rob
	*/
	class Project_Forms_ProjectSave extends Zend_Form
	{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                   
			'text','projectId',array(
			'label'=>'工程编号: ',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required' => true,
			)
		);
			
		 $this->addElement(
			'text', 'name', array(
			'label' => '工程名称: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
     $this->addElement(
			'text', 'dutyName', array(
			'label' => '地址: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(
			'select', 'status', array(
			'label' => '工程状况: ',
		    'multiOptions'=>array('0'=>'未开工','1'=>'建设中','2'=>'已竣工'),
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
    $this->addElement(
			'select', 'structType', array(
			'label' => '结构类型: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(
			'text', 'level', array(
			'label' => '层数: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
	$this->addElement(
			'text', 'amount', array(
			'label' => '合同金额: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
			$this->addElement(
			'textarea', 'purpose', array(
			'label' => '用途: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
			$this->addElement(
			'text', 'constrArea', array(
			'label' => '建筑面积: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
			$this->addElement(
			'text', 'staffNo', array(
			'label' => '作业总人数: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
			$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
			'required' => false,			
			'class'=>'tbMedium tbText'
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
			'text','empId',array(
		//	'filters'=>array('StringTrim'),
			'value'=>'000009',
			'class'=>'hide'
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