<?php
/* Created by   梅墨
   Date of creation  Mar 27th 2011
   Completion date   Mar 27th 2011
*/

class Vehicle_Form_VeRecordSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                                             // 车辆使用记录编号
			'text','recordID',array(
			'label'=>'车辆使用记录编号: ',
			'disabled'=>'disabled',
			//'filters'=>array('StringTrim'),
			'required' => true,
			'class'=>'tbLarge tbText',
			)
		);
			
		$this->addElement(                                            //车辆名称
			'text', 'name', array(
			'label' => ' 车辆名称: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                           //使用日期
			'text', 'dateOfUse', array(
			'label' => '使用日期: ',
			'required' => true,
			'class'=>'tbLager tbText'
			)
		);
    
    	$this->addElement(                                           //使用目的
			'text', 'purpose', array(
			'label' => '使用目的: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //出车公里数
			'text', 'milesBf', array(
			'label' => '出车公里数: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		
		$this->addElement(                                          //还车公里数
			'text', 'milesAf', array(
			'label' => '还车公里数: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		
		$this->addElement(                                          //驾驶员
			'text', 'pilot', array(
			'label' => '驾驶员: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //其他使用人
			'text', 'otherUsers', array(
			'label' => '其他使用人: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //备注
			'textarray', 'remark', array(
			'label' => '备注: ',
			'required' => false,
			'class'=>'tbLarge tbText'
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

