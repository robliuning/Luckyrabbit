<?php
//updated in 6th June 2011 by rob

class Employee_Forms_ContactSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text', 'name', array(
			'label' => '*姓名:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText pfocus'
			)
		);
		$this->addElement(
			'select', 'gender', array(
			'label' => '*性别:',
			'multiOptions'=> array('女'=>'女', '男'=>'男'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'birth', array(
			'label' => '*出生日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		 $this->addElement(
			'select', 'titleName', array(
			'label' => '职称:',
			'multiOptions'=> array('高级'=>'高级', '中级'=>'中级', '初级'=>'初级'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'titleSpec', array(
			'label' => '职称专业:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'deptName', array(
			'label' => '部门:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'dutyName', array(
			'label' => '职务:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'edu', array(
			'label' => '*学历:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'enroll', array(
			'label' => '*入职时间:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'political', array(
			'label' => '*政治面貌:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'idCard', array(
			'label' => '身份证:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text', 'ethnic', array(
			'label' => '民族:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'address', array(
			'label' => '本市家庭住址:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'zip', array(
			'label' => '邮编:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'phoneHome', array(
			'label' => '电话(家):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'phoneMob', array(
			'label' => '*手机号:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'residence', array(
			'label' => '户口所在地:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'probStart', array(
			'label' => '试用期起始日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'probEnd', array(
			'label' => '试用期结束日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'profile', array(
			'label' => '档案所在地:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'security', array(
			'label' => '社保现状:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select', 'secIn', array(
			'label' => '社保是否迁入公司:',
			'multiOptions'=> array('是'=>'是', '否'=>'否'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'secDate', array(
			'label' => '社保何时迁入公司:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'medical', array(
			'label' => '入职前体检结果:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'relation1', array(
			'label' => '第一联系人称呼:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'name1', array(
			'label' => '第一联系人姓名:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'company1', array(
			'label' => '第一联系人工作单位:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'address1', array(
			'label' => '第一联系人居住地:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'phone1', array(
			'label' => '第一联系人联系电话:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'relation2', array(
			'label' => '家庭主要成员称呼(1):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'name2', array(
			'label' => '家庭主要成员姓名(1):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'company2', array(
			'label' => '家庭主要成员工作单位(1):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'address2', array(
			'label' => '家庭主要成员居住地(1):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'phone2', array(
			'label' => '家庭主要成员联系电话(1):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'relation3', array(
			'label' => '家庭主要成员称呼(2):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'name3', array(
			'label' => '家庭主要成员姓名(2):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'company3', array(
			'label' => '家庭主要成员工作单位(2):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'address3', array(
			'label' => '家庭主要成员居住地(2):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'phone3', array(
			'label' => '家庭主要成员联系电话(2):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'relation4', array(
			'label' => '家庭主要成员称呼(3):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'name4', array(
			'label' => '家庭主要成员姓名(3):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'company4', array(
			'label' => '家庭主要成员工作单位(3):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'address4', array(
			'label' => '家庭主要成员居住地(3):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'phone4', array(
			'label' => '家庭主要成员联系电话(3):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
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

