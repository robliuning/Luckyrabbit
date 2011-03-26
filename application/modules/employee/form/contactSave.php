/* Created by 
   Date of creation
   Completion date
 */


<?php

class Employee_Form_Edit extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
		
		$this->addElement(
			'text','empId',array(
			'label'=>'员工编号: ',
			'disabled'=>'disabled',
			'filters'=>array('StringTrim'),
			'class'=>'tbLarge tbText',
			)
		);
			
		$this->addElement(
			'text', 'name', array(
			'label' => '员工姓名: ',
			'required' => true,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'select', 'gender', array(
			'label' => '性别: ',
			'multiOptions'=> array('１'=>'男','０'=>'女'),
			'required' => true,
			'class'=>'tbShort tbText'
			)
		);
    
    	$this->addElement(
			'text', 'age', array(
			'label' => '年龄: ',
			'required' => false,
			'class'=>'tbShort tbText'
			)
		);
		
		$this->addElement(
			'select', 'deptName', array(
			'label' => '所属部门: ',
			'multiOptions'=> array('0'=>'暂无','1'=>'安全生产部','2'=>'工程技术部','3'=>'材料供应部','4'=>'经营核算部','5'=>'财务部','6'=>'质检部'),
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'select', 'dutyName', array(
			'label' => '职务: ',
			'multiOptions'=> array('0'=>'暂无','1'=>'公司总经理','2'=>'公司副总经理','3'=>'公司部门经理','4'=>'公司职员','5'=>'项目负责人','6'=>'项目经理','7'=>'项目副经理','8'=>'会计','9'=>'出纳','10'=>'行政','11'=>'秘书','12'=>'司机','13'=>'办公室主任'),
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'titleName', array(
			'label' => '职称: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'idCard', array(
			'label' => '身份证号: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
			'text', 'phone', array(
			'label' => '联系电话: ',
			'required' => false,
			'class'=>'tbLarge tbText'
			)
		);
		
		$this->addElement(
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

