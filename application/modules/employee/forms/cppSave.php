<?php
/*created: 2011.3.27
  author: mingtingling
  review:mingtingling
  review time:2011.4.3
  version: v0.1
*/
class Employee_Forms_CppSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
			/*��λ���*/
			 'text','postId',array(
		        'label'=>'��λ���:',
			    'disabled'=>'disabled',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��λ����*/
	         'select','postName',array(
			    'label'=>'��λ����:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*Ա������*/
		     'text','contactName',array(
			    'label'=>'Ա������:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��������*/
		     'select','projectName',array(
			    'label'=>'��������:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
	    $this->addElement(
			/*��λ֤���*/
		     'text','postType',array(
			    'label'=>'��λ֤���:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��λ֤���*/
		     'text','postCardId',array(
			    'label'=>'��λ֤���:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��ȫ��������֤���*/
		      'text','certId',array(
			    'label'=>'��ȫ��������֤���:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
		     /*Ա��������Ӧ��Id,������*/
		      'text','contactId',array(
			    'label'=>'Ա��ID:',
			    'required'=>false,
			    'class'=>'hide'
			  )
		$this->addElement(
		     /*δ����ǰ�ĸ�λ���,������*/
		      'text','prePostId',array(
			    'label'=>'δ����ǰ�ĸ�λ���:',
			    'required'=>false,
			    'class'=>'hide'
			  )		
		);
		$this->addElement(
		     /*δ����ǰ�ĸ�λ���,������*/
		      'text','preContactId',array(
			    'label'=>'δ����ǰ��Ա��������Ӧ��Id:',
			    'required'=>false,
			    'class'=>'hide'
			  )		
		);
		$this->addElement(
		     /*δ����ǰ�Ĺ���ID,������*/
		      'text','preProjectName',array(
			    'label'=>'δ����ǰ�Ĺ���ID:',
			    'required'=>false,
			    'class'=>'hide'
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
      $this->setElementDecorators(array(
              'ViewHelper','Errors',
                  array(array('data'=>'HtmlTag'),
                  array('tag'=>'td','class'=>'element')),
                  array('Label',array('tag'=>'td')),
                  array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
   	    	 )
	);

		$this->setDecorators(array(
            'FormElements',
            array('HtmlTag',array('tag'=>'table')),
            'Form'
            )
	);

	}
}
?>