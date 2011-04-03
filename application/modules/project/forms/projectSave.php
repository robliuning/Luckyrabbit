<?php
	/*
	Created by Meimo
	Date of creation 4.1.2011
	Completion date
	reviewed: rob
	*/
	class project_Forms_projectSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                   
			'text','projectId',array(
			'label'=>'���̱��: ',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required' => true,
			)
		);
			
		 $this->addElement(
			'text', 'name', array(
			'label' => '��������: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
     $this->addElement(
			'text', 'dutyName', array(
			'label' => '��ַ: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(
			'select', 'status', array(
			'label' => '����״��: ',
		    'multiOptions'=>array('0'=>'δ����','1'=>'������','2'=>'�ѿ���'),
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
    $this->addElement(
			'select', 'structType', array(
			'label' => '�ṹ����: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(
			'text', 'level', array(
			'label' => '����: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
	$this->addElement(
			'text', 'amount', array(
			'label' => '��ͬ���: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
			$this->addElement(
			'textarea', 'purpose', array(
			'label' => '��;: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
			$this->addElement(
			'text', 'constrArea', array(
			'label' => '�������: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
			$this->addElement(
			'text', 'staffNo', array(
			'label' => '��ҵ������: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
			$this->addElement(
			'textarea', 'remark', array(
			'label' => '��ע: ',
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