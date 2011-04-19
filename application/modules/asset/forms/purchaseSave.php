<?php
/*
固定资产购置表表单
author:mingtingling
date:2011-4-17
vision:2.0
*/
class Asset_Forms_PurchaseSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
		  'text','name',array(
			  'label'=>'固定资产名称:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'select','venId',array(
			  'label'=>'供应商名称:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','type',array(
			  'label'=>'固定资产类别:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'text','spec',array(
			  'label'=>'规格型号:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'text','invoice',array(
			  'label'=>'固定资产购置原始单号:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'text','unit',array(
			  'label'=>'单位:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		  'text','price',array(
			  'label'=>'单价:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		  'text','quantity',array(
			  'label'=>'数量:',
			  'class'=>'tbLarge tbText',
			  'required'=>true
		   )
		);
		$this->addElement(
		   'text','amount',array(
			  'label'=>'金额:',
			  'class'=>'tbLarge tbText',
			  'required'=>false
		   )
		);
		$this->addElement(
		   'select','buyerName',array(
			   'label'=>'采购员:',
			   'class'=>'tbLarge tbText ac_contactName',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'text','purDate',array(
			   'label'=>'采购日期:',
			   'class'=>'tbLarge tbText datepicker',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'select','approvName',array(
			   'label'=>'审批人:',
			   'class'=>'tbLarge tbText ac_contactName',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'text','approvDate',array(
			   'label'=>'审批日期:',
			   'class'=>'tbLarge tbText datepicker',
			   'required'=>false
		   )
		);
		$this->addElement(
		    'textarea','remark',array(
			    'label'=>'备注:',
			    'class'=>'tbLarge tbText datepicker',
			    'required'=>false,
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