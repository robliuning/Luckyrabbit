<?php
/*created: 2011.3.26
author: mingtingling
version: v0.1
*/
class Employee_Form_EmployeeSave extends Zend_Form
{
	pubLic function init()
	{
     $this->setMethod('post');
	 $this->addElement(
		 'text','empId',array(
		      'label'=>'Ա�����:',
		      'disabled'=>'disabled',
		      'required'=>true,
		      'filters'=>array('StringTrim'),
		      'class'=>'tbLarge tbText',
		     )
	     );

	 $this->addElement(
			'select', 'deptName', array(
			'label' => '����:',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
     $this->addElement(
			'select', 'dutyName', array(
			'label' => 'ְ��:',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(
			'select', 'titleName', array(
			'label' => 'ְ��:',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
     $this->addElement(
			'select', 'status', array(
			'label' => 'Ա��״̬: ',
		    'multiOptions'=>array('1'=>'��ְ','0'=>'��ְ'),
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