<?php
/*
author:mingtingling
create date:2011.4.9
vision:2.0
*/
class Contract_Forms_ContrqualifSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
			/*�а��̱��*/
		  'select','contractorId',array(
			 'label'=>'�а���:',
			 'class'=>'tbLarge tbText',
			 'required'=>true
		   )
		);
       $this->addElement(
		  /*��������*/
	      'select','qualifSerie',array(
		  	 'label'=>'��������:',
			 'class'=>'tbLarge tbText',
			 'required'=>true
		  )
	   );
	 $this->addElement(
	    /*�������*/	
		 'select','qualifType',array(
		   'label'=>'�������:',
		   'class'=>'tbLarge tbText',
		   'required'=>true
	     )
	  );
	 $this->addElement(
	    /*���ʵȼ�*/
	     'select','qualifGrade',array(
		    'label'=>'���ʵȼ�:',
			 'class'=>'tbLarge tbText',
			 'required'=>false
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