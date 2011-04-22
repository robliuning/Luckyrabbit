<?php
/* Created by Tony
   Date of creation 
   Completion date
 */
class Employee_Forms_ContactSave extends Zend_Form
{

	public function init()
	{
		$this->setMethod('post');
			
		$this->addElement(                   //姓名
			'text', 'name', array(
			'label' => '姓名: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                   //性别
			'select', 'gender', array(
			'label' => '性别: ',
			'multiOptions'=> array('1'=>'男','0'=>'女'),
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
	
		 $this->addElement(					//职称
			'select', 'titleName', array(
			'label' => '职称: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                  //出生日期
			'text', 'birth', array(
			'label' => '出生日期: ',
			'required' => false,
			'class'=>'tbMedium tbText datepicker'
			)
		);
		
		$this->addElement(                  //身份证
			'text', 'idCard', array(
			'label' => '身份证: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                     //电话号码
			'text', 'phoneNo', array(
			'label' => '联系方式: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                    //其他联系电话
			'text', 'otherContact', array(
			'label' => ' 其他联系方式: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'address', array(
			'label' => '现住址: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
			'required' => false,
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 20
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

