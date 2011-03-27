<?php
/* Created by Tony
   Date of creation 
   Completion date
 */

class Employee_Form_ContactSave extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(                   // 通讯录编号
			'text','contactId',array(
			'label'=>'通讯录编号: ',
			'disabled'=>'disabled',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
			
		$this->addElement(                   //姓名
			'text', 'name', array(
			'label' => '姓名: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                   //性别
			'select', 'gender', array(
			'label' => '性别: ',
			'multiOptions'=> array('１'=>'男','０'=>'女'),
			'required' => true,
			'class'=>'tbShort tbText'
			)
		);
    
    	$this->addElement(                  //出生日期
			'text', 'birth', array(
			'label' => '出生日期: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                  //身份证
			'text', 'idCard', array(
			'label' => '身份证: ',
			//'multiOptions'=> array('0'=>'暂无','1'=>'安全生产部','2'=>'工程技术部','3'=>'材料供应部','4'=>'经营核算部','5'=>'财务部','6'=>'质检部'),
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                     //电话号码
			'text', 'phoneNo', array(
			'label' => '联系方式: ',
			//'multiOptions'=> array('0'=>'暂无','1'=>'公司总经理','2'=>'公司副总经理','3'=>'公司部门经理','4'=>'公司职员','5'=>'项目负责人','6'=>'项目经理','7'=>'项目副经理','8'=>'会计','9'=>'出纳','10'=>'行政','11'=>'秘书','12'=>'司机','13'=>'办公室主任'),
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(                    //其他联系电话
			'text', 'otherContact', array(
			'label' => ' 其他联系方式: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'address', array(
			'label' => '现住址: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'remark', array(
			'label' => '备注: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
	/*	$this->addElement(
			'text', 'otherContact', array(
			'label' => '其他联系方式: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'address', array(
			'label' => '现住址: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'select', 'status', array(
			'label' => '员工状态: ',
			'multiOptions'=> array('1'=>'在职','0'=>'离职'),
			'required' => false,
			'class'=>'tbMedium tbText'
			)
		);
		
		$this->addElement(
			'textarea', 'remark', array(
			'label' => '备注: ',
			'required' => false,
			'class'=>'tbLarge tbText',
			'rows' => 5,
			'cols' => 20
			)
		);                                        */
				
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

