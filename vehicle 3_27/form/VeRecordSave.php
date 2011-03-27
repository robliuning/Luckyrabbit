<?php
/* Created by   ÷ī
   Date of creation  Mar 27th 2011
   Completion date   Mar 27th 2011
*/

class Vehicle_Form_VeRecordSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                                             // ����ʹ�ü�¼���
			'text','recordID',array(
			'label'=>'����ʹ�ü�¼���: ',
			'disabled'=>'disabled',
			//'filters'=>array('StringTrim'),
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
		
		$this->addElement(                                           //ʹ������
			'text', 'dateOfUse', array(
			'label' => 'ʹ������: ',
			'required' => true,
			'class'=>'tbLager tbText'
			)
		);
    
    	$this->addElement(                                           //ʹ��Ŀ��
			'text', 'purpose', array(
			'label' => 'ʹ��Ŀ��: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //����������
			'text', 'milesBf', array(
			'label' => '����������: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		
		$this->addElement(                                          //����������
			'text', 'milesAf', array(
			'label' => '����������: ',
			'required' => true,
			'class'=>'tbMedium tbText'
			)
		);
		
		$this->addElement(                                          //��ʻԱ
			'text', 'pilot', array(
			'label' => '��ʻԱ: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                                          //����ʹ����
			'text', 'otherUsers', array(
			'label' => '����ʹ����: ',
			'required' => false,
			'class'=>'tbLarge tbText'
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

