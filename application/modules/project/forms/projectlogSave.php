<?php
	/*
	Created by Meimo
	Date of creation 4.1.2011
	Completion date
	*/
	class project_Forms_projectSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                   //
			'text','projectId',array(
			'label'=>'工程编号: ',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			'required' => true,
			'disabled' =>'disabled',
			)
		);
			
		 $this->addElement(             //
			'text', 'logDate', array(
			'label' => '日期: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
     $this->addElement(                //
			'text', 'weather', array(
			'label' => '天气: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
	 $this->addElement(              //
			'text', 'tempHi', array(
			'label' => '最高温度: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
    $this->addElement(                 //
			'text', 'tempLo', array(
			'label' => '最低温度: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
	$this->addElement(                  //
			'textarea', 'progress', array(
			'label' => '生产进度情况: ',
			'required' => false,
			'class'=>'tbSmall tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'qualityPbl', array(
			'label' => '质量问题: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                           //
			'textarea', 'saftyPbl', array(
			'label' => '安全问题: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'otherPbl', array(
			'label' => '其他问题: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                           //
			'textarea', 'relatedFile', array(
			'label' => '来往文件: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                          //
			'textarea', 'mMinutes', array(
			'label' => '会议记录: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'changeSig', array(
			'label' => '变更签证: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                        //
			'textarea', 'material', array(
			'label' => '材料设备使用情况: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                      //
			'textarea', 'machine', array(
			'label' => '施工机具使用情况: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
    $this->addElement(                        //
			'textarea', 'utility', array(
			'label' => '水电气情况: ',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                           //
			'textarea', 'remark', array(
			'label' => '备注',
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
	$this->addElement(                                //
			'textarea', 'cTime', array(
			'label' => '创建时间: ',
			'required' => false,
			'class'=>'tbMedium tbText'
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
    	
    $this->addElement(                 
			'text','empId',array(
		//	'filters'=>array('StringTrim'),
			'value'=>'000009',
			'class'=>'hide'
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