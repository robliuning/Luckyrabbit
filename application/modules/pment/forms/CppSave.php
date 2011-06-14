<?php
//updated in 9th June by rob
class Pment_Forms_CppSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'text','contactName',array(
			'label'=>'*员工姓名:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'select','postId',array(
			'label'=>'岗位名称:',
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','qualif',array(
			'label'=>'*执业资格:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text','certId',array(
			'label'=>'*证书编号:',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'text','startDate',array(
			'label'=>'*开始承担责任时间:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea', 'responsi', array(
			'label' => '岗位职责:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
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
			'text','contactId',array(
			'required'=>false,
			'class'=>'hide ac_contactId'
			)
		);
		$this->setElementDecorators(array(
			'ViewHelper','Errors',
			array(array('data'=>'HtmlTag'),
			array('tag'=>'td','class'=>'element')),
			array('Label',array('tag'=>'td')),
			array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
			)
		);
		$this->setDecorators(array(
			'FormElements',
			array('HtmlTag',array('tag'=>'table')),
			'Form'
			)
		);
	}
}
?>