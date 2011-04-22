<?php
	/*
	Created by Meimo
	Date 2011.4.17
	*/
class Worker_Forms_workerSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'text', 'name', array(
			'label' => '工人姓名: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
     	$this->addElement(
			'select', 'teamId', array(
			'label' => '班组名称: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'phoneNo', array(
			'label' => '联系电话: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'address', array(
			'label' => '家庭住址: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'cert', array(
			'label' => '岗位证编号: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'textarea', 'skill', array(
			'label' => '技能: ',
			'required' => false,
			'class'=>'tbText',
			'cols'=>60,
			'rows'=>20
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