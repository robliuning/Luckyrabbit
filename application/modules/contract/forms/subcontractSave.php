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
			/*工程编号*/
			'text','projectId',array(
			'label'=>'工程编号:',
			'required'=>true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			/*分包类型*/
			'select','scontrType',array(
			'label'=>'分包类型:',
			'required'=>true,
			'multiOptions'=>array('1'=>'专业承包', '2'=>'劳务分包'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			/*分包商编号*/
			'text','contractorId',array(
			'label'=>'分包商编号:',
			'required'=>true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			/*分包项目及描述*/
			'textarea','scontrDetail',array(
			'label'=>'分包项目及描述:',
			'required'=>false,
			'class'=>'tbText'
			'cols'=> 60,
			'rows'=> 20
			)
		);
		$this->addElement(
			/*质量等级*/
			'select','quality',array(
			'label'=>'质量等级:',
			'required'=>false,
			'multiOptions'=>array('2'=>'优良', '1'=>'合格', '0'=>'基本合格'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			/*预计开始日期*/
			'text','startDateExp',array(
			'label'=>'预计开始日期:',
			'required'=>false,
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			/*预计结束时间*/
			'text','endDateExp',array(
			'label'=>'预计结束时间:',
			'required'=>false,
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			/*预计工期*/
			'text','periodExp',array(
			'label'=>'预计工期:',
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			/*实际开始时间*/
			'text','startDateAct',array(
			'label'=>'实际开始时间:',
			'required'=>false,
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			/*实际结束时间*/
			'text','endDateAct',array(
			'label'=>'实际结束时间:',
			'required'=>false,
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			/*实际工期*/
			'text','periodAct',array(
			'label'=>'实际工期:',
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			/*承包人违约情况*/
			'textarea','brConContr',array(
			'label'=>'承包人违约情况:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 20
			)
		);
		$this->addElement(
			/*承包人违约责任*/
			'textarea','brResContr',array(
			'label'=>'承包人违约责任:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 20
			)
		);
		$this->addElement(
			/*分包商违约情况*/
			'textarea','brConSContr',array(
			'label'=>'分包商违约责任:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 20
			)
		);
		$this->addElement(
			/*分包商违约责任*/
			'textarea','brResSContr',array(
			'label'=>'分包商违约责任:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 20
			)
		);
		$this->addElement(
			/*保修信息*/
			'textarea','warranty',array(
			'label'=>'保修信息:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 20
			)
		);
		$this->addElement(
			/*合同造价*/
			'text','contrAmt',array(
			'label'=>'合同造价:',
			'required'=>false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			/*施工保证金*/
			'text','consMargin',array(
			'label'=>'施工保证金:',
			'required'=>false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			/*工程保证金*/
			'text','prjMargin',array(
			'label'=>'工程保证金:',
			'required'=>false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			/*工程保修金*/	
			'text','prjWarr',array(
			'label'=>'工程保修金:',
			'required'=>false,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			/*备注*/
			'textarea','remark',array(
			'label'=>'备注',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 20
			)
		);
		$this->addElement(
			/*按钮一*/
			'submit','submit',array(
			'ignore'=>true,
			'class'=>'btConfirm radius',
			'name'=>'submit'
			)
		);
		$this->addElement(
			/*按钮二*/
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