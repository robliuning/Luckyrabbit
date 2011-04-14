<?php
	/*
	Created by Meimo
	Date 2011.4.14
	*/
class Material_Forms_MaterialSave extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
			
		$this->addElement(
			'text', 'name', array(
			'label' => '材料名称: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
     	$this->addElement(
			'text', 'typeId', array(
			'label' => '类型: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
	  	$this->addElement(
			'text', 'spec', array(
			'label' => '规格型号: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
    	$this->addElement(
			'text', 'unit', array(
			'label' => '单位: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);


		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
			'required' => false,			
			'class'=>'tbLarge tbText',
			'cols'=>40,
			'rows'=>5
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