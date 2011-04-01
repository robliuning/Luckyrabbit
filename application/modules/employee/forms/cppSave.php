<?php
/*created: 2011.3.27
  author: mingtingling
  version: v0.1
*/
class Employee_Forms_PostSave extends Zend_Form
{
	public function init()
	{
		$this->setMethod('post');
		$this->addElement(
			/*��λ�����*/
			 'text','postid',array(
		        'label'=>'��λ���:',
			    'disabled'=>'disabled',
			    'required'=>false,
			    'filters'=>array('StringTrim'),
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��λ����*/
	         'select','postname',array(
			    'label'=>'��λ����:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*����*/
		     'text','contactname',array(
			    'label'=>'����:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��������*/
		     'select','projectname',array(
			    'label'=>'��������:',
			    'required'=>true,
			    'class'=>'tbLarge tbText'
		      )
		);
	    $this->addElement(
			/*��λ֤���*/
		     'text','posttype',array(
			    'label'=>'��λ֤���:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��λ֤���*/
		     'text','postcardid',array(
			    'label'=>'��λ֤���:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
		$this->addElement(
			/*��ȫ��������֤���*/
		      'text','certid',array(
			    'label'=>'��ȫ��������֤���:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
       $this->addElement(
			/*��ϵ�绰*/
		      'text','contactno',array(
			    'label'=>'��ϵ�绰:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
       $this->addElement(
			/*������ϵ��ʽ*/
		      'text','othercontact',array(
			    'label'=>'������ϵ��ʽ:',
			    'required'=>false,
			    'class'=>'tbLarge tbText'
		      )
		);
       $this->addElement(
			/*��ע*/
		      'textarea','remark',array(
			    'label'=>'��ע:',
			    'required'=>false,
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