<?php
/*
	Richard Song
	2011.4.27
*/
class Contract_Forms_SubcontractSave  extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');

		$this->addElement(
			'select','projectId',array(
			'label'=>'��������:',
			'required'=>true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'select','scontrType',array(
			'label'=>'�ְ�����:',
			'required'=>true,
			'multiOptions'=>array('1'=>'רҵ�а�', '2'=>'����ְ�'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'select','contractorId',array(
			'label'=>'�ְ�������:',
			'required'=>true,
			'class'=>'tbLarge tbText'
			)
		);
		$this->addElement(
			'textarea','scontrDetail',array(
			'label'=>'�ְ���Ŀ������:',
			'required'=>false,
			'class'=>'tbText'
			'cols'=> 60,
			'rows'=> 4
			)
		);
		$this->addElement(
			'select','quality',array(
			'label'=>'�����ȼ�:',
			'required'=>false,
			'multiOptions'=>array('0'=>'�����ϸ�', '1'=>'�ϸ�', '2'=>'����'),
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','startDateExp',array(
			'label'=>'Ԥ�ƿ�ʼ����:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','endDateExp',array(
			'label'=>'Ԥ�ƽ���ʱ��:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','startDateAct',array(
			'label'=>'ʵ�ʿ�ʼʱ��:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'text','endDateAct',array(
			'label'=>'ʵ�ʽ���ʱ��:',
			'required'=>false,
			'filters'=>array('StringTrim'),
			'class'=>'tbMedium tbText datepicker'
			)
		);
		$this->addElement(
			'textarea','brConContr',array(
			'label'=>'�а���ΥԼ���:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brResContr',array(
			'label'=>'�а���ΥԼ����:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brConSContr',array(
			'label'=>'�ְ���ΥԼ����:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','brResSContr',array(
			'label'=>'�ְ���ΥԼ����:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'textarea','warranty',array(
			'label'=>'������Ϣ:',
			'required'=>false,
			'class'=>'tbText'
			'cols' => 60,
			'rows' => 4
			)
		);
		$this->addElement(
			'text','contrAmt',array(
			'label'=>'��ͬ���:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','consMargin',array(
			'label'=>'ʩ����֤��:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','prjMargin',array(
			'label'=>'���̱�֤��:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'text','prjWarr',array(
			'label'=>'���̱��޽�:',
			'filters'=>array('StringTrim'),
			'required'=>false,
			'class'=>'tbMedium tbText'
			)
		);
		$this->addElement(
			'textarea','remark',array(
			'label'=>'��ע',
			'required'=>false,
			'class'=>'tbText'
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