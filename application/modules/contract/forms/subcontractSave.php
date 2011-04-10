<?php
/*
author:mingtingling
date:2011.4.10
vision:2.0
*/
class Contract_Forms_SubcontractSave  extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
		 /*���̱��*/
		'text','projectId',array(
			 'label'=>'���̱��:',
			 'required'=>true,
			 'class'=>'tbLarge tbText'
		   )
		);
		$this->addElement(
		  /*�ְ�����*/
		 'select','scontrType',array(
			  'label'=>'�ְ�����:',
			  'required'=>true,
			  'multiOptions'=>array('1'=>'רҵ�а�','2'=>'����ְ�'),
			  'class'=>'tbLarge tbText'
		   )
		);
	   $this->addElement(
		  /*�ְ��̱��*/
	    'text','contractorId',array(
		      'label'=>'�ְ��̱��:',
			  'required'=>true,
			  'class'=>'tbLarge tbText'
		  )
	   );
	  $this->addElement(
	    /*�ְ���Ŀ������*/
	    'text','scontrDetail',array(
		      'label'=>'�ְ���Ŀ������:',
			  'required'=>false,
			  'class'=>'tbLarge tbText'
		  )
	  );
	 $this->addElement(
	   /*�����ȼ�*/
	  'select','quality',array(
		    'label'=>'�����ȼ�:',
		    'required'=>false,
		    'multiOptions'=>array('2'=>'����','1'=>'�ϸ�','0'=>'�����ϸ�'),
		    'class'=>'tbLarge tbText'
	   )
	 );
	 $this->addElement(
	   /*Ԥ�ƿ�ʼ����*/
	  'text','startDateExp',array(
		    'label'=>'Ԥ�ƿ�ʼ����:',
		    'required'=>false,
		    'class'=>'tbLarge tbText'
	    )
	 );
	$this->addElement(
	   /*Ԥ�ƽ���ʱ��*/
	   'text','endDateExp',array(
		     'label'=>'Ԥ�ƽ���ʱ��:',
		     'required'=>false,
		     'class'=>'tbLarge tbText'
	     )
	);
	$this->addElement(
	   /*Ԥ�ƹ���*/
	    'text','periodExp',array(
		      'label'=>'Ԥ�ƹ���:',
			  'required'=>false,
			  'class'=>'tbText tbLarge'
		 )
	);
	$this->addElement(
	   /*ʵ�ʿ�ʼʱ��*/
	     'text','startDateAct',array(
		       'label'=>'ʵ�ʿ�ʼʱ��:',
			   'required'=>false,
			   'class'=>'tbText tbLarge'
	     )
	);
	$this->addElement(
	   /*ʵ�ʽ���ʱ��*/
	      'text','endDateAct',array(
		       'label'=>'ʵ�ʽ���ʱ��:',
			   'required'=>false,
			   'class'=>'tbLarge tbText'
		  )
	);
	$this->addElement(
	   /*ʵ�ʹ���*/
	     'text','periodAct',array(
		     'label'=>'ʵ�ʹ���:',
			 'required'=>false,
			 'class'=>'tbLarge tbText'
		  )
	);
	$this->addElement(
	   /*�а���ΥԼ���*/
	   'text','brConContr',array(
		     'label'=>'�а���ΥԼ���:',
		     'required'=>false,
		     'class'=>'tbLarge tbText'
	     )
	);
	$this->addElement(
	   /*�а���ΥԼ����*/
	   'text','brResContr',array(
		    'label'=>'�а���ΥԼ����:',
		    'required'=>false,
		    'class'=>'tbLarge tbText'
	    )
	);
  $this->addElement(
    /*�ְ���ΥԼ���*/
     'text','brConSContr',array(
		 'label'=>'�ְ���ΥԼ����:',
		 'required'=>false,
		 'class'=>'tbLarge tbText'
	   )
  );
 $this->addElement(
    /*�ְ���ΥԼ����*/
    'text','brResSContr',array(
	     'label'=>'�ְ���ΥԼ����:',
		 'required'=>false,
		 'class'=>'tbLarge tbText'
	  )
 );
$this->addElement(
   /*������Ϣ*/
   'text','warranty',array(
	      'label'=>'������Ϣ:',
	      'required'=>false,
	      'class'=>'tbLarge tbText'
     )
);
$this->addElement(
   /*��ͬ���*/
   'text','contrAmt',array(
	      'label'=>'��ͬ���:',
	      'required'=>false,
	      'class'=>'tbLarge tbText'
     )
);
$this->addElement(
   /*ʩ����֤��*/
   'text','consMargin',array(
	     'label'=>'ʩ����֤��:',
	     'required'=>false,
	     'class'=>'tbLarge tbText'
     )
);
$this->addElement(
   /*���̱�֤��*/
   'text','prjMargin',array(
	      'label'=>'���̱�֤��:',
	      'required'=>false,
	      'class'=>'tbLarge tbText'
      )
);
$this->addElement(
   /*���̱��޽�*/	
  'text','prjWarr',array(
	      'label'=>'���̱��޽�:',
	      'required'=>false,
	      'class'=>'tbLarge tbText'
     )
);
$this->addElement(
   /*��ע*/
   'textarea','remark',array(
	      'label'=>'��ע',
	      'required'=>false,
	      'class'=>'tbLarge tbText'
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