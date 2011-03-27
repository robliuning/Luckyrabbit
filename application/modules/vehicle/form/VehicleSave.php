<?php
/* Created by        ÷ī
   Date of creation  Mar 27th 2011 
   Completion date   Mar 27th 2011
*/

class Vehicle_Form_VehicleSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                                             // ���ƺ�
			'text','plateNo',array(
			'label'=>'���ƺ�: ',
			'disabled'=>'disabled',
			'filters'=>array('StringTrim'),
			'required' => true,
			'class'=>'tbLarge tbText',
			)
		);
			
		$this->addElement(                                            //��������
			'text', 'name', array(
			'label' => ' ��������: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                           //������ʻ֤��
			'text', 'license', array(
			'label' => '������ʻ֤��: ',
			'filters'=>array('StringTrim'),
			'required' => false,
			'class'=>'tbLager tbText'
			)
		);
    
    	$this->addElement(                                           //����������
			'text', 'personIC', array(
			'label' => '����������: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //��Ҫʹ����Ա
			'text', 'users', array(
			'label' => '��Ҫʹ����Ա: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //��׼�ͺ�
			'text', 'fuelCons', array(
			'label' => '��׼�ͺ�: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
		
		$this->addElement(                                          //��ע
			'textarray', 'remark', array(
			'label' => '��ע: ',
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

