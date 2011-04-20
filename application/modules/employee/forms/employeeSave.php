<?php
/* Created by Tony
   Date of creation 
   Completion date
 */

class Employee_Forms_EmployeeSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                   
			'text','name',array(
			'label'=>'员工姓名: ',
			'required' => true,
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText ac_contactName',
			)
		);
			
		 $this->addElement(
			'select', 'deptName', array(
			'label' => '部门: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
     	$this->addElement(
			'select', 'dutyName', array(
			'label' => '职务: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);

    	$this->addElement(
			'select', 'status', array(
			'label' => '员工状态: ',
		    'multiOptions'=>array('0'=>'在职','1'=>'离职'),
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
			'required' => true,
			'class'=>'hide ac_contactId'
			)
		);
    	
    	$this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data'=>'HtmlTag'),
            array('tag'=>'td','class'=>'element')),
            array('Label',array('tag'=>'td')),
            array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
   		 ));

		$this->setDecorators(array(
            'FormElements',
            array('HtmlTag',array('tag'=>'table')),
            'Form'
        ));
    }
}
?>

