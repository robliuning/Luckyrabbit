<?php
/*created: 2011.3.26
author: mingtingling
version: v0.1
*/
class Employee_Form_Employeesave extends Zend_Form
{
	pubic function init()
	{
     $this->setMethod('post');
	 $this->addElement(
		 'text','empId',array(
		      'label'=>'员工编号:',
		      'disabled'=>'disabled',
		      'required'=>true,
		      'filters'=>array('StringTrim'),
		      'class'=>'tbLarge tbText',
		     )
	     );

	 $this->addElement(
			'select', 'deptName', array(
			'label' => '部门:',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
     $this->addElement(
			'select', 'dutyName', array(
			'label' => '职务:',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(
			'select', 'titleName', array(
			'label' => '职称:',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
     $this->addElement(
			'select', 'status', array(
			'label' => '员工状态: ',
		    'multiOptions'=>array('1'=>'在职','0'=>'离职'),
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