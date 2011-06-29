<?php
//updated on 31th May by Rob

class Pment_Forms_SealSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'textarea', 'name', array(
			'label' => '*用章名称:',
			'class'=>'tbText pfocus',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'sealFile', array(
			'label' => '*用章文件:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'sealUser', array(
			'label' => '*使用人:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea', 'reason', array(
			'label' => '*使用事由:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'text', 'sealDate', array(
			'label' => '*使用日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'returnDate', array(
			'label' => '*归还日期:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text', 'copy', array(
			'label' => '*份数:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text', 'contactName', array(
			'label' => '*经办人:',
			'filters' => array('StringTrim'),
			'class'=>'tbMedium tbText ac_contactName'
			)
		);
		$this->addElement(
			'select', 'takeOut', array(
			'label' => '是否带出:',
			'multiOptions'=>array('是'=>'是','否'=>'否'),
			'class'=>'tbMedium tbText'
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
			'text', 'contactId', array(
			'filters' => array('StringTrim'),
			'class'=>'hide ac_contactId'
			)
		);
		$this->setElementDecorators(
			array(
				'ViewHelper',
				'Errors',
				array(array('data'=>'HtmlTag'),
				array('tag'=>'td','class'=>'element')),
				array('Label',array('tag'=>'td')),
				array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
			)
		);
		$this->setDecorators(
			array(
				'FormElements',
				array('HtmlTag',array('tag'=>'table')),
				'Form'
			)
		);
	}
}
?>