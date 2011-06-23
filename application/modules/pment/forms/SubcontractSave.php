<?php
//updated in 22th June by Rob

class Pment_Forms_SubcontractSave  extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','scontrType',array(
			'label'=>'分包类型:',
			'multiOptions'=>array('专业分包'=>'专业承包', '劳务分包'=>'劳务分包'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select','contractorId',array(
			'label'=>'分包商名称:',
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'textarea','content',array(
			'label'=>'*分包项目:',
			'class'=>'tbText pfocus',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'textarea','detail',array(
			'label'=>'具体描述:',
			'class'=>'tbText',
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'select','quality',array(
			'label'=>'质量等级:',
			'multiOptions'=>array('优良'=>'优良', '中等'=>'中等', '合格'=>'合格'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','startDateExp',array(
			'label'=>'预计进场日期:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','endDateExp',array(
			'label'=>'预计完成时间:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','startDateAct',array(
			'label'=>'实际进场时间:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','endDateAct',array(
			'label'=>'实际完成时间:',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea','brConContr',array(
			'label'=>'承包方违约情况:',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brResContr',array(
			'label'=>'承包方违约责任:',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brConSContr',array(
			'label'=>'分包方违约责任:',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brResSContr',array(
			'label'=>'分包方违约责任:',
			'class'=>'tbText',
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text','contrAmt',array(
			'label'=>'合同金额(元人民币):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','guarantee',array(
			'label'=>'履约保函(元人民币):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);

		$this->addElement(
			'text','prjMargin',array(
			'label'=>'工程保证金(元人民币):',
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','prjWarr',array(
			'label'=>'工程保修金(元人民币):',
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