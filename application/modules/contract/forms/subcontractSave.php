<?php
/*
author:mingtingling
date:2011.4.10
vision:2.0
*/
class Contract_Forms_SubcontractSave  extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','projectId',array(
			'label'=>'工程名称:',
			'required'=>true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'select','scontrType',array(
			'label'=>'分包类型:',
			'required'=>true,
			'multiOptions'=>array('专业分包'=>'专业承包', '劳务分包'=>'劳务分包'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select','contractorId',array(
			'label'=>'分包商名称:',
			'required'=>true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'textarea','scontrDetail',array(
			'label'=>'分包项目及描述:',
			'required'=>false,
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'select','quality',array(
			'label'=>'质量等级:',
			'required'=>false,
			'multiOptions'=>array('基本合格'=>'基本合格', '合格'=>'合格', '优良'=>'优良'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','startDateExp',array(
			'label'=>'预计开始日期:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','endDateExp',array(
			'label'=>'预计结束时间:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','startDateAct',array(
			'label'=>'实际开始时间:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','endDateAct',array(
			'label'=>'实际结束时间:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea','brConContr',array(
			'label'=>'承包人违约情况:',
			'required'=>false,
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brResContr',array(
			'label'=>'承包人违约责任:',
			'required'=>false,
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brConSContr',array(
			'label'=>'分包商违约责任:',
			'required'=>false,
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brResSContr',array(
			'label'=>'分包商违约责任:',
			'required'=>false,
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','warranty',array(
			'label'=>'保修信息:',
			'required'=>false,
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text','contrAmt',array(
			'label'=>'合同造价:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','consMargin',array(
			'label'=>'施工保证金:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','prjMargin',array(
			'label'=>'工程保证金:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','prjWarr',array(
			'label'=>'工程保修金:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'备注',
			'required'=>false,
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