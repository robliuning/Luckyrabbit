<?php
	/*
	Created by Meimo
	Date of creation 4.1.2011
	Completion date
	*/
	class project_Forms_projectSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                   //
			'text','projectId',array(
			'label'=>'���̱��: ',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required' => true,
			'disabled' =>'disabled',
			)
		);
			
		 $this->addElement(             //
			'text', 'logDate', array(
			'label' => '����: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
     $this->addElement(                //
			'text', 'weather', array(
			'label' => '����: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(              //
			'text', 'tempHi', array(
			'label' => '����¶�: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
    $this->addElement(                 //
			'text', 'tempLo', array(
			'label' => '����¶�: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
	$this->addElement(                  //
			'textarea', 'progress', array(
			'label' => '�����������: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'qualityPbl', array(
			'label' => '��������: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                           //
			'textarea', 'saftyPbl', array(
			'label' => '��ȫ����: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'otherPbl', array(
			'label' => '��������: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                           //
			'textarea', 'relatedFile', array(
			'label' => '�����ļ�: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                          //
			'textarea', 'mMinutes', array(
			'label' => '�����¼: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'changeSig', array(
			'label' => '���ǩ֤: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'material', array(
			'label' => '�����豸ʹ�����: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                      //
			'textarea', 'machine', array(
			'label' => 'ʩ������ʹ�����: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
    $this->addElement(                        //
			'textarea', 'utility', array(
			'label' => 'ˮ�������: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                           //
			'textarea', 'remark', array(
			'label' => '��ע',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                                //
			'textarea', 'cTime', array(
			'label' => '����ʱ��: ',
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