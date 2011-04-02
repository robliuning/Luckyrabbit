<?php
/* Created by Meimo
   Date of creation 4.1.2011
   Completion date
 */

class project_Forms_progressSave extends Zend_Form
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
			'select', 'stage', array(
			'label' => '�׶�: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
     $this->addElement(
			'text', 'task', array(
			'label' => '�׶�����: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(
			'text', 'startDateExp', array(
			'label' => '��ʼ����: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
    $this->addElement(
			'text', 'endDateExp', array(
			'label' => 'Ԥ�ƽ�������: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);	
	$this->addElement(                   
			'text','periodExp',array(
			'label'=>'Ԥ�ƹ���: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'text','endDateAct',array(
			'label'=>'ʵ���������: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'text','periodAct',array(
			'label'=>'ʵ�ʹ���: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'select','quality',array(
			'label'=>'�������: ',
		    'multiOptions'=>array('0'=>'���ϸ�','1'=>'�ϸ�','2'=>'����','3'=>'����'),
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'textarea','remark',array(
			'label'=>'��ע: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'text','cTime',array(
			'label'=>'����ʱ��: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
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