<?php
/*
author:ming tingling
create date:2011.4.4
vision:2.0
*/
class Contract_Forms_ContractSave extends Zend_Form
{
     public function init()
	{
		 $this->setMethod('post');
		 $this->addElement(
		   /*承包商编号*/      
		 'text','contractorId',array(
			 'label'=>'承包商编号:',
			 'class'=>'tbLarge tbText',
             'required'=>false,
			 'disabled'=>'disabled'
		   )
		 );
          $this->addElement(
		      /*承包商名称*/
		  'text','name',array(
			   'label'=>'承包商名称:',
			   'class'=>'tbLarge tbText',
			   'required'=>true
		     )
		  );
		  $this->addElement(
			  /*联系电话*/
		   'text','phoneNo',array(
			    'label'=>'联系电话:' ,
			    'class'=>'tbLarge tbText',
			    'required'=>false
		     )
		  );
		  $this->addElement(
			  /*法定负责人*/
		    'text','artiPerson',array(
			    'label'=>'法定负责人:',
			    'class'=>'tbLarge tbText',
			    'required'=>false
		     )
		  );
		  $this->addElement(
			  /*资质序列*/
			   'select','qualifSerie', array(
				  'label'=>'资质序列:',
				   'class'=>'tbLarge tbText',
				   'required'=>false
			     )
		   );
		 $this->addElement(
		      /*资质类别*/
		       'select','qualifType',array(
				 'label'=>'资质类别:',
				 'class'=>'tbLarge tbText',
				  'required'=>false
			   )
		  );
		$this->addElement(
		    /*资质等级*/
		   'select','qualifGrade',array(
			    'label'=>'资质等级:',
			    'class'=>'tbLarge tbText',
			    'required'=>false
		    )
		);
       $this->addElement(
		    /*许可证号*/
	        'text','licenseNo',array(
			     'label'=>'许可证号:',
				 'class'=>'tbLarge tbText',
				 'required'=>false
			  )
	   );
	 $this->addElement(
	      /*其他联系方式*/
	       'text','otherContact',array(
			   'label'=>'其他联系方式:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		    )
	 );
	$this->addElement(
	     /*	地址*/
	       'text','address',array(
			   'label'=>'地址:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		    )
	 );
	$this->addElement(
	    /*承包商业务范围*/	
		 'textarea','busiField',array(
		     'label'=>'承包商业务范围:',
		     'class'=>'tbLarge tbText',
		     'required'=>false
	   )
	);
   $this->addElement(
        /*备注*/
        'textarea','remark',array(
		    'label'=>'备注:',
			'class'=>'tbLarge tbText',
			'required'=>false
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
?>