<?php
/*
author:ming tingling
create date:2011.4.4
review:mingtingling
date:2011.4.9
vision:2.0
*/
class Contract_Forms_ContractSave extends Zend_Form
{
     public function init()
	{
		 $this->setMethod('post');
          $this->addElement(
		      /*�а�������*/
		  'text','name',array(
			   'label'=>'�а�������:',
			   'class'=>'tbLarge tbText',
			   'required'=>true
		     )
		  );
		  $this->addElement(
			  /*����������*/
		    'text','artiPerson',array(
			    'label'=>'����������:',
			    'class'=>'tbLarge tbText',
			    'required'=>false
		     )
		  );
       $this->addElement(
		    /*���֤��*/
	        'text','licenseNo',array(
			     'label'=>'���֤��:',
				 'class'=>'tbLarge tbText',
				 'required'=>false
			  )
	   );
       $this->addElement(
		    /*�а���ҵ��Χ*/
	        'textarea','busiField',array(
			     'label'=>'�а���ҵ��Χ:',
				 'class'=>'tbLarge tbText',
				 'required'=>false
			  )
	   );
	  $this->addElement(
			  /*��ϵ�绰*/
		   'text','phoneNo',array(
			    'label'=>'��ϵ�绰:' ,
			    'class'=>'tbLarge tbText',
			    'required'=>false
		     )
		  );
	 $this->addElement(
	      /*������ϵ��ʽ*/
	       'text','otherContact',array(
			   'label'=>'������ϵ��ʽ:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		    )
	 );
	$this->addElement(
	     /*	��ַ*/
	       'text','address',array(
			   'label'=>'��ַ:',
			   'class'=>'tbLarge tbText',
			   'required'=>false
		    )
	 );
   $this->addElement(
        /*��ע*/
        'textarea','remark',array(
		    'label'=>'��ע:',
			'class'=>'tbLarge tbText',
			'required'=>false
		 )
   );
  $this->addElement(
       /*��ťһ*/
       'submit','submit',array(
		   'ignore'=>true,
		   'class'=>'btConfirm radius',
           'name'=>'submit'
	     )
  );
  $this->addElement(
      /*��ť��*/
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