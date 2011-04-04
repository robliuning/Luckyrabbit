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
			'text', 'progressId', array(
			'class'=>'hide'
			)
		);
		
		$this->addElement(                   
			'select','projectId',array(
			'label'=>'工程名称: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required' => true,
			)
		);
			
		 $this->addElement(
			'text', 'stage', array(
			'label' => '阶段: ',
			'required' => true,
			'class'=>'tbLarge tbText',
			'value'=>'1'
			)
		);
     $this->addElement(
			'text', 'task', array(
			'label' => '阶段任务: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(
			'text', 'startDateExp', array(
			'label' => '起始日期: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
    $this->addElement(
			'text', 'endDateExp', array(
			'label' => '预计结束日期: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);	
	$this->addElement(                   
			'text','periodExp',array(
			'label'=>'预计工期: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'text','endDateAct',array(
			'label'=>'实际完成日期: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'text','periodAct',array(
			'label'=>'实际工期: ',
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'select','quality',array(
			'label'=>'完成质量: ',
		    'multiOptions'=>array('0'=>'不合格','1'=>'合格','2'=>'良好','3'=>'优秀'),
		//	'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
	$this->addElement(                   
			'textarea','remark',array(
			'label'=>'备注: ',
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