<?php
/* Created by        梅墨
   Date of creation  Mar 27th 2011 
   Completion date   Mar 27th 2011
*/

class Vehicle_Form_VehicleSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                                             // 车牌号
			'text','plateNo',array(
			'label'=>'车牌号: ',
			'disabled'=>'disabled',
			'filters'=>array('StringTrim'),
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
		
		$this->addElement(                                           //车辆行驶证号
			'text', 'license', array(
			'label' => '车辆行驶证号: ',
			'filters'=>array('StringTrim'),
			'required' => false,
			'class'=>'tbLager tbText'
			)
		);
    
    	$this->addElement(                                           //车辆负责人
			'text', 'personIC', array(
			'label' => '车辆负责人: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //主要使用人员
			'text', 'users', array(
			'label' => '主要使用人员: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //标准油耗
			'text', 'fuelCons', array(
			'label' => '标准油耗: ',
			'required' => false,
			'class'=>'tbMedium tbText'
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

